<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Schedule Event Repository
 *
 * @author moysesoliveira
 */
class ScheduleEvent extends AbstractRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function data(array $request): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.chrTitle AS title', 't.vrcDescription as description', 't.fkCategory', 'c.chrCategory', 't.dttBegin', 't.dttFinish'])
            ->from(\Data\Entity\Cns\ScheduleEvent::class, 't')
            ->join(\Data\Entity\Cns\ScheduleCategory::class, 'c', Join::WITH, 'c.id=t.fkCategory')
            ->where('t.dttDeleted IS NULL')
            ->orderBy('t.dttBegin', 'ASC');

        if($request['start'])
            $qb->andWhere('t.dttBegin >= :start')->setParameter('start', \DateTime::createFromFormat('Y-m-d H:i', $request['start'] . ' 00:00')->format('Y-m-d H:i'));

        if($request['start'])
            $qb->andWhere('t.dttFinish <= :end')->setParameter('end', \DateTime::createFromFormat('Y-m-d H:i', $request['end'] . ' 23:59')->format('Y-m-d H:i'));

        $collection = $qb->getQuery()->getResult();
        
        foreach($collection as &$data):
            $data['start'] = $data['dttBegin']->format('c');
            $data['end'] = $data['dttFinish']->format('c');
            unset($data['dttBegin'], $data['dttFinish']);
        endforeach;
        return $collection;
    }
}