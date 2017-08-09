<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * User Repository
 *
 * @author moysesoliveira
 */
class User extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.vrcName', 't.vrcEmail'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName', 't.vrcEmail'])
            ->from('Data\Entity\Acl\User', 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcEmail LIKE :vrcEmail OR t.vrcName LIKE :vrcName)');
        $qb->setParameter('vrcName', $search);
        $qb->setParameter('vrcEmail', $search);

        return $qb;
    }
    
    /**
     * 
     * @param string $id
     * @param string $vrcName
     * @param string $vrcEmail
     * @return type
     */
    public function isRepeated($id, string $vrcEmail)
    {
        if(!$id)
            $id = '0';
        
        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Acl\User', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcEmail LIKE :vrcEmail)')
                ->setParameters(compact('id', 'vrcEmail'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
