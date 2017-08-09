<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of Module
 *
 * @author moysesoliveira
 */
class Module extends DataTableRepository {

    /**
     * Build query to use at 
     * 
     * @param array $request
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['c.vrcLabel', 'a.vrcAlias', 't.vrcAlias'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select([
                't.id',
                'c.vrcLabel AS category',
                'a.vrcAlias AS app',
                't.vrcAlias AS alias'
            ])
            ->from('Data\Entity\Acl\Module', 't')
            ->join('Data\Entity\Acl\App', 'a', Join::WITH, 'a.id=t.fkApp AND a.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\Category', 'c', Join::WITH, 'c.id=t.fkCategory AND c.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL');
        if($orderColumn == 'a.vrcLabel'):
            $qb->orderBy($orderColumn, $dtr['dir'])->addOrderBy('t.vrcLabel', $dtr['dir']);
        else:
            $qb->orderBy($orderColumn, $dtr['dir']);
        endif;

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $arSearch = [];
        $arSearch[] = 't.vrcAlias LIKE :alias';
        $arSearch[] = 'c.vrcLabel LIKE :category';
        $arSearch[] = 'a.vrcAlias LIKE :app';
        $qb->andWhere('(' . implode(' OR ', $arSearch) . ')');
        $qb->setParameter('alias', $search);
        $qb->setParameter('category', $search);
        $qb->setParameter('app', $search);

        return $qb;
    }
    
    /**
     * 
     * @param integer $id
     * @param string $vrcAlias
     * @return boolean
     */
    public function isRepeated($id, $fkApp, $vrcAlias)
    {
        if(!$id)
            $id = '0';
        
        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Acl\Module', 't')
                ->where('t.dttDeleted IS NULL')
                ->andWhere('t.id <> :id')
                ->andWhere('t.fkApp = :fkApp')
                ->andWhere('t.vrcAlias LIKE :vrcAlias')
                ->setParameters(compact('id', 'fkApp', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
