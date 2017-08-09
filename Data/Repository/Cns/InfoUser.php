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
        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName'])
            ->from('Data\Entity\Acl\User', 't')
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
     * @param string $fkInfo
     * @return array
     */
    public function getValues(string $fkInfo): array
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(['p.id'])
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Acl\User', 'p', Join::WITH, 'p.id=t.fkUser AND p.dttDeleted IS NULL')
            ->join('Data\Entity\Cns\Info', 'u', Join::WITH, 'u.id=t.fkInfo AND u.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkInfo=:fkInfo')
            ->setParameter('fkInfo', $fkInfo);

        $results = $qb->getQuery()->getResult();
        $actives = [];
        foreach($results as $data)
            $actives[] = $data['id'];

        return $actives;
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getNewMessagesByUser(string $fkUser): array
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(['i.id','i.vrcSummary AS summary', 'i.vrcDescription AS description', 'i.dttPosted'])
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Cns\Info', 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND t.dttChecked IS NULL')
            ->setParameter('fkUser', $fkUser);

        $results = $qb->getQuery()->getResult();
        foreach($results as &$data):
            $data['from'] = 'system';
            $data['posted'] = $data['dttPosted']->format('d/m/Y H:i');
        endforeach;

        return $results;
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    public function getTotalNewMessagesByUser(string $fkUser): string
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(['count(t.id) AS total'])
            ->from('Data\Entity\Cns\InfoUser', 't')
            ->join('Data\Entity\Cns\Info', 'i', Join::WITH, 'i.id=t.fkInfo AND i.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser AND t.dttChecked IS NULL')
            ->setParameter('fkUser', $fkUser);

        return $qb->getQuery()->getOneOrNullResult()['total'];
    }

}
