<?php

namespace Data\Repository\Cms;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * ArticleGroup Repository
 *
 * @author moysesoliveira
 */
class ArticleGroup extends DataTableRepository {

    /**
     * 
     * @param array $request
     * @return QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.vrcName', 't.vrcAlias'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select(['t.id', 't.vrcName', 't.vrcAlias'])
            ->from('Data\Entity\Cms\ArticleGroup', 't')
            ->where('t.dttDeleted IS NULL')
            ->orderBy($orderColumn, $dtr['dir']);

        if(!$dtr['search'])
            return $qb;

        $search = '%' . $dtr['search'] . '%';
        $qb->andWhere('(t.vrcName LIKE :name OR t.vrcAlias LIKE :alias)');
        $qb->setParameter('name', $search);
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
                ->select(['t.id', 't.vrcName'])
                ->from('Data\Entity\Cms\ArticleGroup', 't')
                ->where('t.dttDeleted IS NULL')
                ->getQuery()->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['vrcName'];

        return $options;
    }
    
    /**
     * 
     * @param integer $id
     * @param string $vrcName
     * @param string $vrcAlias
     * @return boolean
     */
    public function isRepeated($id, $vrcName, $vrcAlias)
    {
        if(!$id)
            $id = '0';
        
        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Cms\ArticleGroup', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias OR t.vrcName LIKE :vrcName)')
                ->setParameters(compact('id', 'vrcName', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

}
