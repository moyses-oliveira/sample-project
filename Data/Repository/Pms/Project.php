<?php

namespace Data\Repository\Pms;

use Spell\Data\Doctrine\DataTableRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Description of App
 *
 * @author moysesoliveira
 */
class Project extends DataTableRepository {

    /**
     * Build query to use at 
     * 
     * @param array $request
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryBuilder(array $request): QueryBuilder
    {
        $dtr = $this->dataTableRequest($request);
        $orderKeys = ['t.vrcName', 't.vrcAlias'];
        $orderColumn = $orderKeys[$dtr['order']];

        $qb = $this->_em->createQueryBuilder();
        $qb->select([
                't.id',
                't.vrcName',
                't.vrcAlias'
            ])
            ->from('Data\Entity\Pms\Project', 't')
            ->where('t.dttDeleted IS NULL');
        if($orderColumn == 'g.vrcName'):
            $qb->orderBy($orderColumn, $dtr['dir'])->addOrderBy('t.vrcName', $dtr['dir']);
        else:
            $qb->orderBy($orderColumn, $dtr['dir']);
        endif;

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
            ->from('Data\Entity\Pms\Project', 't')
            ->where('t.dttDeleted IS NULL')
            ->getQuery()
            ->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['vrcName'];

        return $options;
    }

    /**
     * 
     * @param string $id
     * @param type $vrcName
     * @param type $vrcAlias
     * @return bool
     */
    public function isRepeated($id, $vrcName, $vrcAlias): bool
    {
        if(!$id)
            $id = '0';

        return $this->_em->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Pms\Project', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias OR t.vrcName LIKE :vrcName)')
                ->setParameters(compact('id', 'vrcName', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

    public function getByAlias(string $vrcAlias): \Data\Entity\Pms\Project
    {
        $entityName = get_class(new \Data\Entity\Pms\Project);
        $response = $this->_em->createQueryBuilder()
                ->select(['t.id'])->from($entityName, 't')
                ->where('t.dttDeleted IS NULL AND t.vrcAlias = :vrcAlias')
                ->setParameters(compact('vrcAlias'))->getQuery()->getOneOrNullResult();
        if(!isset($response['id']))
            throw \Exception('Project alias can\'t be found!');


        return $this->_em->find($entityName, $response['id']);
    }

}
