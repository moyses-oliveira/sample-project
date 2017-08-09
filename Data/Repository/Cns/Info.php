<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of Module
 *
 * @author moysesoliveira
 */
class Info extends DataTableRepository {

    /**
     * Return an array with required information for populate "datatables"
     * 
     * @param array $request
     * @return array
     */
    public function loadData($request)
    {
        $results = new \stdClass();
        $qb = $this->queryBuilder($request);
        $results->data = $this->getAll($qb, $request);
        
        foreach($results->data as &$data)
            $data['dttPostedFormated'] = $data['dttPosted']->format('d/m/Y H:i');
        
        $total = $this->getTotal($qb);
        $results->recordsFiltered = $total;
        $results->recordsTotal = $results->recordsFiltered;
        return (array) $results;
    }

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.dttPosted', 't.vrcSummary'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.dttPosted', 't.vrcSummary'])
            ->from('Data\Entity\Cns\Info', 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcSummary LIKE :summary)');
        $qb->setParameter('summary', $search);
        return $qb;
    }

}
