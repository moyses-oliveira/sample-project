<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * App Repository
 *
 * @author moysesoliveira
 */
class App extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.vrcAlias'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.vrcAlias'])
            ->from('Data\Entity\Acl\App', 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcAlias LIKE :alias)');
        $qb->setParameter('alias', $search);

        return $qb;
    }

    /**
     * 
     * @return array
     */
    public function options()
    {
        $data = $this->_em->createQueryBuilder()
                ->select(['t.id', 't.vrcAlias'])
                ->from('Data\Entity\Acl\App', 't')
                ->where('t.dttDeleted IS NULL')
                ->getQuery()->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['vrcAlias'];

        return $options;
    }

    /**
     * 
     * @param integer $id
     * @param string $vrcName
     * @param string $vrcAlias
     * @return boolean
     */
    public function isRepeated($id, $vrcAlias)
    {
        if(!$id)
            $id = '0';

        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Acl\App', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias)')
                ->setParameters(compact('id', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
