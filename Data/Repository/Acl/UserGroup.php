<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * UserGroup
 *
 * @author moysesoliveira
 */
class UserGroup extends AbstractRepository {

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName'])
            ->from(\Data\Entity\Acl\Group::class, 't')
            ->where('t.dttDeleted IS NULL')
            ->addOrderBy('t.vrcName');

        $results = $qb->getQuery()->getResult();
        $options = [];
        foreach($results as $data)
            $options[$data['id']] = $data['vrcName'];

        return $options;
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getValues(string $fkUser): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['g.id'])
            ->from(\Data\Entity\Acl\UserGroup::class, 't')
            ->join(\Data\Entity\Acl\Group::class, 'g', Join::WITH, 'g.id=t.fkGroup AND g.dttDeleted IS NULL')
            ->join(\Data\Entity\Acl\User::class, 'u', Join::WITH, 'u.id=t.fkUser AND u.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser')
            ->setParameter('fkUser', $fkUser);

        $results = $qb->getQuery()->getResult();
        $actives = [];
        foreach($results as $data)
            $actives[] = $data['id'];

        return $actives;
    }
    
    
    public function getUserCollectionByGroupAlias($vrcAlias) {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.fkUser AS id'])
            ->from(\Data\Entity\Acl\UserGroup::class, 't')
            ->join(\Data\Entity\Acl\Group::class, 'g', Join::WITH, 'g.id=t.fkGroup AND g.dttDeleted IS NULL AND g.vrcAlias=:vrcAlias')
            ->where('t.dttDeleted IS NULL')
            ->setParameters(compact('vrcAlias'));
        $results = $qb->getQuery()->getResult();
        $userCollection = [];
        foreach($results as $data)
            $userCollection[] = $data['id'];

        return $userCollection;
        
    }
    
    
    public function getUserCollectionById($fkGroup) {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.fkUser AS id'])
            ->from(\Data\Entity\Acl\UserGroup::class, 't')
            ->where('t.dttDeleted IS NULL AND t.fkGroup=:fkGroup')
            ->setParameters(compact('fkGroup'));
        $results = $qb->getQuery()->getResult();
        $userCollection = [];
        foreach($results as $data)
            $userCollection[] = $data['id'];

        return $userCollection;
        
    }
    
    public function getRel() {
        $qb = $this->getEm()->createQueryBuilder();
        $result = $qb->select(['t.fkUser', 't.fkGroup'])
            ->from(\Data\Entity\Acl\UserGroup::class, 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy('t.fkGroup','asc')
            ->getQuery()->getResult();
        
        $collection = [];
        foreach($result as $data):
            $fkGroup = $data['fkGroup'];
            if(!isset($collection[$fkGroup]))
                $collection[$fkGroup] = [];
            
            $collection[$fkGroup][] = $data['fkUser'];
        endforeach;
        
        return $collection;
    }

}
