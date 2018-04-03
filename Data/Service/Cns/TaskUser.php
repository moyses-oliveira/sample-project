<?php

namespace Data\Service\Cns;

use Spell\Data\Doctrine\AbstractService;

/**
 * Service save cns_info_user
 *
 * @author moysesoliveira
 */
class TaskUser extends AbstractService {

    public function saveCollection($fkTask, array $collection)
    {
        $this->clearRows($fkTask);
        foreach($collection as $fkUser)
            $this->saveRow($fkTask, $fkUser);
    }

    private function saveRow($fkTask, $fkUser)
    {
        $params = compact('fkTask', 'fkUser');
        if($this->isRegistered($params))
            return $this->update($params);

        return $this->insert($params);
    }

    private function isRegistered($params)
    {
        $result = $this->getEm()->createQueryBuilder()
                ->from(\Data\Entity\Cns\TaskUser::class, 't')
                ->select('COUNT(t) as rows')
                ->where('t.fkTask=:fkTask', 't.fkUser=:fkUser')
                ->setParameters($params)->getQuery()->getOneOrNullResult();

        return $result ? current($result) > 0 : null;
    }

    public function clearRows($fkTask)
    {
        $this->getEm()->createQueryBuilder()
            ->update(\Data\Entity\Cns\TaskUser::class, 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkTask=:fkTask')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkTask', $fkTask)
            ->getQuery()->execute();
        return true;
    }

    public function checkRows(int $fkTask, bool $endTask = true)
    {
        if($endTask):
            /* @var $entity \Data\Entity\Cns\Task */
            $entity = (new \Data\Entity\Cns\Task())->load($fkTask);
            $entity->setDttFinished(new \DateTime());
            $entity->persist([]);
        endif;
        
        $this->getEm()->createQueryBuilder()
            ->update(\Data\Entity\Cns\TaskUser::class, 't')
            ->set('t.dttChecked', ':dttChecked')
            ->where('t.fkTask=:fkTask')
            ->setParameter('dttChecked', new \DateTime())
            ->setParameter('fkTask', $fkTask)
            ->getQuery()->execute();
        return true;
    }

    private function update($params)
    {
        $this->getEm()->createQueryBuilder()
            ->update(\Data\Entity\Cns\TaskUser::class, 't')
            ->set('t.dttChecked', ':dttChecked')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkTask=:fkTask', 't.fkUser=:fkUser')
            ->setParameters($params)
            ->setParameter('dttChecked', null)
            ->setParameter('dttDeleted', null)
            ->getQuery()->execute();
        return true;
    }

    public function acceptMessage($fkTask, $fkUser)
    {
        $this->getEm()->createQueryBuilder()
            ->update(\Data\Entity\Cns\TaskUser::class, 't')
            ->set('t.dttChecked', ':dttChecked')
            ->where('t.fkTask=:fkTask', 't.fkUser=:fkUser')
            ->setParameters(compact('fkTask', 'fkUser'))
            ->setParameter('dttChecked', new \DateTime())
            ->getQuery()->execute();
        $success = true;
        $errors = [];
        $data = new \stdClass();
        return compact('success', 'errors', 'data');
    }

    /**
     * 
     * @param type $data
     * @param type $pk
     * @return type
     * @throws \Entity
     */
    private function insert(array $params)
    {
        $entity = new \Data\Entity\Cns\TaskUser();
        $entity->persist($params);
        return $entity;
    }

}
