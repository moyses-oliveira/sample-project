<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Group Repository
 *
 * @author moysesoliveira
 */
class Group extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.vrcAlias', 't.vrcName'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.vrcAlias', 't.vrcName'])
            ->from(\Data\Entity\Acl\Group::class, 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if (!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcName LIKE :name OR t.vrcAlias LIKE :alias)');
        $qb->setParameter('name', $search);
        $qb->setParameter('alias', $search);

        return $qb;
    }

    /**
     * 
     * @param integer $id
     * @param string $vrcAlias
     * @return boolean
     */
    public function isRepeated($id, $vrcName, $vrcAlias)
    {
        if (!$id)
            $id = '0';

        return $this->getEm()->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from(\Data\Entity\Acl\Group::class, 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias OR t.vrcName LIKE :vrcName)')
                ->setParameters(compact('id', 'vrcName', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
