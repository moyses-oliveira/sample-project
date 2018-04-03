<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Task
 *
 * @author moysesoliveira
 */
class TaskUser extends AbstractRepository {

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getNewMessagesByUser(string $fkUser): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['i.id', 'i.vrcSummary AS summary', 'i.vrcDescription AS description', 'i.vrcUrl as url', 'u.vrcName as user', 'i.dttPosted'])
            ->from(\Data\Entity\Cns\TaskUser::class, 't')
            ->join(\Data\Entity\Cns\Task::class, 'i', Join::WITH, 'i.id=t.fkTask AND i.dttDeleted IS NULL')
            ->leftJoin(\Data\Entity\Acl\User::class, 'u', Join::WITH, 'u.id=i.fkUser')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND t.dttChecked IS NULL')
            ->setParameter('fkUser', $fkUser);

        $results = $qb->getQuery()->getResult();
        foreach ($results as &$data):
            $data['from'] = !!$data['user'] ? $data['user'] : 'Sistema';
            $data['posted'] = $data['dttPosted']->format('d/m/Y H:i');
        endforeach;

        return $results;
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getTotalNewMessagesByUser(int $fkUser): string
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['count(t.id) AS total'])
            ->from(\Data\Entity\Cns\TaskUser::class, 't')
            ->join(\Data\Entity\Cns\Task::class, 'i', Join::WITH, 'i.id=t.fkTask AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND t.dttChecked IS NULL')
            ->setParameter('fkUser', $fkUser);

        return $qb->getQuery()->getOneOrNullResult()['total'];
    }

}
