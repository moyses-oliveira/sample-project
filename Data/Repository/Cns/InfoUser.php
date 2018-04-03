<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Info
 *
 * @author moysesoliveira
 */
class InfoUser extends AbstractRepository {

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName'])
            ->from('Data\Entity\Acl\User', 't')
            ->where('t.dttDeleted IS NULL AND t.chrType=:chrType')
            ->addOrderBy('t.vrcName')
            ->setParameter('chrType', 'default');

        $results = $qb->getQuery()->getResult();
        $options = [];
        foreach ($results as $data)
            $options[$data['id']] = $data['vrcName'];

        return $options;
    }

    /**
     * 
     * @param string $fkInfo
     * @return array
     */
    public function getValues(string $fkInfo): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['u.id'])
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Acl\User', 'u', Join::WITH, 'u.id=t.fkUser AND u.dttDeleted IS NULL')
            ->join('Data\Entity\Cns\Info', 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkInfo=:fkInfo')
            ->setParameter('fkInfo', $fkInfo);

        $results = $qb->getQuery()->getResult();
        $actives = [];
        foreach ($results as $data)
            $actives[] = $data['id'];

        return $actives;
    }
    
    public function getActives($fkInfo): array 
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['u.id', 'u.vrcName', 't.dttChecked'])
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Acl\User', 'u', Join::WITH, 'u.id=t.fkUser AND u.dttDeleted IS NULL')
            ->join('Data\Entity\Cns\Info', 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkInfo=:fkInfo')
            ->setParameter('fkInfo', $fkInfo);
        return $qb->getQuery()->getResult();
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getNewMessagesByUser(string $fkUser): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['i.id', 'i.vrcSummary AS summary', 'i.vrcDescription AS description', 'u.vrcName as user', 'i.dttPosted'])
            ->from(\Data\Entity\Cns\InfoUser::class, 't')
            ->join(\Data\Entity\Cns\Info::class, 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
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
    public function getNewUrgentMessagesByUser(string $fkUser): array
    {
        $tnyLevel = 1;
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['i.id', 'i.vrcSummary AS summary', 'i.vrcDescription AS description', 'u.vrcName as user', 'i.dttPosted'])
            ->from(\Data\Entity\Cns\InfoUser::class, 't')
            ->join(\Data\Entity\Cns\Info::class, 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->leftJoin(\Data\Entity\Acl\User::class, 'u', Join::WITH, 'u.id=i.fkUser')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND t.dttChecked IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND i.tnyLevel=:tnyLevel AND t.dttChecked IS NULL')
            ->setParameter('tnyLevel', $tnyLevel)
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
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Cns\Info', 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND t.dttChecked IS NULL')
            ->setParameter('fkUser', $fkUser);

        return $qb->getQuery()->getOneOrNullResult()['total'];
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getTotalNewUrgentMessagesByUser(int $fkUser): string
    {
        $tnyLevel = 1;
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['count(t.id) AS total'])
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Cns\Info', 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND i.tnyLevel=:tnyLevel AND t.dttChecked IS NULL')
            ->setParameter('tnyLevel', $tnyLevel)
            ->setParameter('fkUser', $fkUser);

        return $qb->getQuery()->getOneOrNullResult()['total'];
    }

}
