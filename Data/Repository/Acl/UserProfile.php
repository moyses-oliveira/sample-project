<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * User
 *
 * @author moysesoliveira
 */
class UserProfile extends AbstractRepository {

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName'])
            ->from('Data\Entity\Acl\Profile', 't')
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
        $qb->select(['p.id'])
            ->from('Data\Entity\Acl\UserProfile', 't')
            ->join('Data\Entity\Acl\Profile', 'p', Join::WITH, 'p.id=t.fkProfile AND p.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\User', 'u', Join::WITH, 'u.id=t.fkUser AND u.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser')
            ->setParameter('fkUser', $fkUser);

        $results = $qb->getQuery()->getResult();
        $actives = [];
        foreach($results as $data)
            $actives[] = $data['id'];

        return $actives;
    }
    
    
    public function getUserCollectionByProfileAlias($vrcAlias) {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.fkUser AS id'])
            ->from('Data\Entity\Acl\UserProfile', 't')
            ->join('Data\Entity\Acl\Profile', 'p', Join::WITH, 'p.id=t.fkProfile AND p.dttDeleted IS NULL AND p.vrcAlias=:vrcAlias')
            ->where('t.dttDeleted IS NULL')
            ->setParameters(compact('vrcAlias'));
        $results = $qb->getQuery()->getResult();
        $userCollection = [];
        foreach($results as $data)
            $userCollection[] = $data['id'];

        return $userCollection;
        
    }

}
