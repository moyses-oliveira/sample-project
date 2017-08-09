<?php

namespace Data\Repository\Cms;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of App
 *
 * @author moysesoliveira
 */
class ArticleCategory extends DataTableRepository {

    /**
     * Build query to use at 
     * 
     * @param array $request
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['g.vrcName', 't.vrcName', 't.vrcAlias'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select([
                't.id',
                't.vrcName AS categoryName',
                't.vrcAlias AS categoryAlias',
                'g.vrcName AS groupName',
                'g.vrcAlias AS groupAlias'
            ])
            ->from('Data\Entity\Cms\ArticleCategory', 't')
            ->join('Data\Entity\Cms\ArticleGroup', 'g', Join::WITH, 'g.id=t.fkGroup AND g.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL');
        if($orderColumn == 'g.vrcName'):
            $qb->orderBy($orderColumn, $dtr['dir'])->addOrderBy('t.vrcName', $dtr['dir']);
        else:
            $qb->orderBy($orderColumn, $dtr['dir']);
        endif;

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcName LIKE :name OR t.vrcAlias LIKE :alias OR g.vrcAlias LIKE :aalias)');
        $qb->setParameter('name', $search);
        $qb->setParameter('alias', $search);
        $qb->setParameter('aalias', $search);

        return $qb;
    }

    /**
     * 
     * @return array
     */
    public function options($fkGroup)
    {
        $data = $this->_em->createQueryBuilder()
                ->select(['t.id', 't.vrcName'])
                ->from('Data\Entity\Cms\ArticleCategory', 't')
                ->where('t.dttDeleted IS NULL AND t.fkGroup=:fkGroup')
                ->setParameter('fkGroup', $fkGroup)
                ->getQuery()
                ->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['vrcName'];

        return $options;
    }
    
    /**
     * 
     * @param integer $id
     * @param string $vrcAlias
     * @return boolean
     */
    public function isRepeated($id, $fkGroup, $vrcName, $vrcAlias)
    {
        if(!$id)
            $id = '0';
        
        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Cms\ArticleCategory', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id AND t.fkGroup = :fkGroup')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias OR t.vrcName LIKE :vrcName)')
                ->setParameters(compact('id', 'fkGroup', 'vrcName', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
