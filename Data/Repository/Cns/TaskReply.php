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
class TaskReply extends AbstractRepository {

    /**
     * 
     * @param int $fkTask
     * @return array
     */
    public function getFromFkTask(int $fkTask): array
    {
        $qb = $this->getEm()
            ->createQueryBuilder()
            ->select(['t.id', 't.vrcReply', 't.dttPosted', 'u.vrcName'])
            ->from(\Data\Entity\Cns\TaskReply::class, 't')
            ->leftJoin(\Data\Entity\Acl\User::class, 'u', Join::WITH, 'u.id=t.fkUser')
            ->where('t.dttDeleted IS NULL AND t.fkTask=:fkTask')
            ->setParameter('fkTask', $fkTask);
            
        return $qb->getQuery()->getResult();
    }

}
