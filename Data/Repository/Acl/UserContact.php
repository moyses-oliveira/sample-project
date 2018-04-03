<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Customer Repository
 *
 * @author moysesoliveira
 */
class UserContact extends AbstractRepository {

    public function options($fkUser) {
        return $this->getEm()->createQueryBuilder()
                ->select(['t.id', 't.fkContactMode', 't.vrcContact'])
                ->from('Data\Entity\Acl\UserContact', 't')
                ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser')
                ->setParameter('fkUser', $fkUser)
                ->getQuery()
                ->getResult();
    }

    public function info($fkUser) {
        return $this->getEm()->createQueryBuilder()
                ->select(['l.chrAlias as label', 't.vrcContact as info'])
                ->from(\Data\Entity\Acl\UserContact::class, 't')
                ->join(\Data\Entity\Acl\UserContactMode::class, 'l', Join::WITH, 'l.id=t.fkContactMode')
                ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser')
                ->setParameter('fkUser', $fkUser)
                ->getQuery()
                ->getResult();
    }
}
