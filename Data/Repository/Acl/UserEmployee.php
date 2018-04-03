<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * User Repository
 *
 * @author moysesoliveira
 */
class UserEmployee extends DataTableRepository {

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

        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName', 't.vrcEmail'])
            ->from(\Data\Entity\Acl\User::class, 't')
            ->join(\Data\Entity\Acl\UserEmployee::class, 'e', Join::WITH, 'e.fkUser=t.id')
            ->where('t.dttDeleted IS NULL AND t.chrType!=:dev')
            ->setParameter('dev', 'dev')
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
        
        return $this->getEm()->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Acl\User', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcEmail LIKE :vrcEmail)')
                ->setParameters(compact('id', 'vrcEmail'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }
    
    /**
     * 
     * @param string $vrcEmail
     * @return \Data\Entity\Acl\User|null
     */
    public function getByEmail(string $vrcEmail): ?\Data\Entity\Acl\User
    {
        return $this->getEm()->createQueryBuilder()
                ->select('t')
                ->from('Data\Entity\Acl\User', 't')
                ->where('t.dttDeleted IS NULL AND t.vrcEmail LIKE :vrcEmail')
                ->setParameter('vrcEmail', strtolower($vrcEmail))->getQuery()->getOneOrNullResult();
    }
    
    
    public function options(string $except): array
    {
        $results = $this->getEm()->createQueryBuilder()
                ->select('t')
                ->from(\Data\Entity\Acl\User::class, 't')
                ->join(\Data\Entity\Acl\UserEmployee::class, 'e', Join::WITH, 'e.fkUser=t.id')
                ->where('t.dttDeleted IS NULL AND t.id <> :except')
                ->setParameter('except', $except)
                ->getQuery()
                ->getResult();
        
        $options = [];
        foreach($results as $entity)
            $options[$entity->getId()] = $entity->getVrcName();
        
        return $options;
    }
    

}
