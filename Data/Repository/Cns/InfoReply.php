<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of Module
 *
 * @author moysesoliveira
 */
class InfoReply extends AbstractRepository {

    /**
     * 
     * @param int $fkInfo
     * @return array
     */
    public function getFromFkInfo(int $fkInfo): array
    {
        $qb = $this->getEm()
            ->createQueryBuilder()
            ->select(['t.id', 't.vrcReply', 't.dttPosted', 'u.vrcName'])
            ->from(\Data\Entity\Cns\InfoReply::class, 't')
            ->leftJoin(\Data\Entity\Acl\User::class, 'u', Join::WITH, 'u.id=t.fkUser')
            ->where('t.dttDeleted IS NULL AND t.fkInfo=:fkInfo')
            ->setParameter('fkInfo', $fkInfo);
            
        return $qb->getQuery()->getResult();
    }

}
