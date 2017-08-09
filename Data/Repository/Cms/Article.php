<?php

namespace Data\Repository\Cms;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Article Repository
 *
 * @author moysesoliveira
 */
class Article extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.vrcTitle', 'c.vrcName'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.fkGroup', 't.vrcTitle', 'c.vrcName AS vrcCategory'])
            ->from('Data\Entity\Cms\Article', 't')
            ->join('Data\Entity\Cms\ArticleCategory', 'c', Join::WITH, 'c.id=t.fkCategory')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);
            

        if(!$dtr['search'])
            return $qb;

            $search = '%' . $dtr['search'] . '%';
            $qb->andWhere('(c.vrcName LIKE :vrcName OR t.vrcTitle LIKE :vrcTitle)');
            $qb->setParameter('vrcTitle', $search);
            $qb->setParameter('vrcName', $search);

        return $qb;
    }
    
    /**
     * 
     * @param string $id
     * @param string $vrcTitle
     * @param string $vrcEmail
     * @return type
     */
    public function isRepeated($id, string $vrcAlias)
    {
        if(!$id)
            $id = '0';
        
        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Cms\Article', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias)')
                ->setParameters(compact('id', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
