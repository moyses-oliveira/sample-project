<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Category Repository
 *
 * @author moysesoliveira
 */
class Category extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.tnyPriority', 't.vrcLabel'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.vrcIcon', 't.vrcLabel'])
            ->from('Data\Entity\Acl\Category', 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcLabel LIKE :name)');
        $qb->setParameter('name', $search);
        $qb->setParameter('alias', $search);

        return $qb;
    }

    /**
     * 
     * @return array
     */
    public function options()
    {
        $data = $this->_em->createQueryBuilder()
                ->select(['t.id', 't.vrcLabel'])
                ->from('Data\Entity\Acl\Category', 't')
                ->where('t.dttDeleted IS NULL')
                ->getQuery()->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['vrcLabel'];

        return $options;
    }
    
    /**
     * 
     * @param integer $id
     * @param string $vrcLabel
     * @param string $vrcAlias
     * @return boolean
     */
    public function isRepeated($id, $vrcLabel)
    {
        if(!$id)
            $id = '0';
        
        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Acl\Category', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('t.vrcLabel LIKE :vrcLabel')
                ->setParameters(compact('id', 'vrcLabel'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
