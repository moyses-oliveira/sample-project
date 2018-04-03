<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Schedule Category Repository
 *
 * @author moysesoliveira
 */
class ScheduleCategory extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.chrCategory'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['t.id', 't.chrCategory'])
            ->from(\Data\Entity\Cns\ScheduleCategory::class, 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.chrCategory LIKE :name)');
        $qb->setParameter('name', $search);

        return $qb;
    }

    /**
     * 
     * @return array
     */
    public function options(): array
    {
        $data = $this->getEm()->createQueryBuilder()
                ->select(['t.id', 't.chrCategory'])
                ->from(\Data\Entity\Cns\ScheduleCategory::class, 't')
                ->where('t.dttDeleted IS NULL')
                ->getQuery()->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['chrCategory'];

        return $options;
    }
    
    /**
     * 
     * @param int|null $id
     * @param string $chrCategory
     * @return bool
     */
    public function isRepeated(?int $id, string $chrCategory): bool
    {
        if(!$id)
            $id = '0';
        
        return $this->getEm()->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from(\Data\Entity\Cns\ScheduleCategory::class, 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('t.chrCategory LIKE :chrCategory')
                ->setParameters(compact('id', 'chrCategory'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }
}