<?php

namespace Data\Repository\Pms;

use Doctrine\ORM\Query\Expr\Join;
use Spell\Data\Doctrine\AbstractRepository;

/**
 * Description of App
 *
 * @author moysesoliveira
 */
class Post extends AbstractRepository {

    /**
     * 
     * @param string $vrcAlias
     * @return array
     */
    public function getAll(string $vrcAlias): array
    {
        $qb = $this->getEm()->createQueryBuilder()
            ->select([
                't.id',
                't.fkUser',
                'u.vrcName',
                't.chrType',
                't.dttCreated',
                't.vrcTitle',
                't.txtNote'
            ])
            ->from('Data\Entity\Pms\Post', 't')
            ->join('Data\Entity\Pms\Project', 'p', Join::WITH, 'p.id=t.fkProject AND p.vrcAlias=:vrcAlias')
            ->join('Data\Entity\Acl\User', 'u', Join::WITH, 'u.id=t.fkUser')
            ->where('t.dttDeleted IS NULL')
            ->setParameter('vrcAlias', $vrcAlias)
            ->orderBy('t.dttCreated', 'desc');

        return $qb->getQuery()->getResult();
    }

    /**
     * 
     * @return array
     */
    public function options()
    {
        $data = $this->getEm()->createQueryBuilder()
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

        return $this->getEm()->createQueryBuilder()
                ->select(['COUNT(t) AS total'])
                ->from('Data\Entity\Pms\Project', 't')
                ->where('t.dttDeleted IS NULL AND t.id <> :id')
                ->andWhere('(t.vrcAlias LIKE :vrcAlias OR t.vrcName LIKE :vrcName)')
                ->setParameters(compact('id', 'vrcName', 'vrcAlias'))->getQuery()->getOneOrNullResult()['total'] > 0;
    }

    public function getByAlias(string $vrcAlias): \Data\Entity\Pms\Project
    {
        $entityName = get_class(new \Data\Entity\Pms\Project);
        $response = $this->getEm()->createQueryBuilder()
                ->select(['t.id'])->from($entityName, 't')
                ->where('t.dttDeleted IS NULL AND t.vrcAlias = :vrcAlias')
                ->setParameters(compact('vrcAlias'))->getQuery()->getOneOrNullResult();
        if(!isset($response['id']))
            throw \Exception('Project alias can\'t be found!');


        return $this->getEm()->find($entityName, $response['id']);
    }

}
