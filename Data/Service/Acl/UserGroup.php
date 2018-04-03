<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;

/**
 * Description of UserGroup
 *
 * @author moysesoliveira
 */
class UserGroup extends AbstractService {

    /**
     *
     * @var type 
     */
    private $modules = [];

    /**
     *
     * @var \Data\Entity\Acl\UserGroup
     */
    protected $entity = null;


    public function saveCollection($fkUser, array $collection)
    {
        $this->clearRows($fkUser);
        foreach($collection as $fkGroup)
            $this->saveRow($fkUser, $fkGroup);
    }

    private function saveRow($fkUser, $fkGroup)
    {
        $params = compact('fkUser', 'fkGroup');
        if($this->isRegistered($params))
            return $this->update($params);

        return $this->insert($params);
    }

    private function isRegistered($params)
    {
        $result = $this->getEm()->createQueryBuilder()
                ->from('Data\Entity\Acl\UserGroup', 't')
                ->select('COUNT(t) as rows')
                ->where('t.fkUser=:fkUser', 't.fkGroup=:fkGroup')
                ->setParameters($params)->getQuery()->getOneOrNullResult();

        return $result ? current($result) > 0 : null;
    }

    public function clearRows($fkUser)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Acl\UserGroup', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkUser=:fkUser')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkUser', $fkUser)
            ->getQuery()->execute();
        return true;
    }

    private function update($params)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Acl\UserGroup', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkUser=:fkUser', 't.fkGroup=:fkGroup')
            ->setParameters($params)
            ->setParameter('dttDeleted', null)
            ->getQuery()->execute();
        return true;
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
        $entity = new \Data\Entity\Acl\UserGroup();
        $entity->persist($params);
        return $entity;
    }

}
