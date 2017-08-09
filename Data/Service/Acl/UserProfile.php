<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;

/**
 * Description of UserProfile
 *
 * @author moysesoliveira
 */
class UserProfile extends AbstractService {

    /**
     *
     * @var type 
     */
    private $modules = [];

    /**
     *
     * @var \Data\Entity\Acl\UserProfile
     */
    protected $entity = null;


    public function saveCollection($fkUser, array $collection)
    {
        $this->clearRows($fkUser);
        foreach($collection as $fkProfile)
            $this->saveRow($fkUser, $fkProfile);
    }

    private function saveRow($fkUser, $fkProfile)
    {
        $params = compact('fkUser', 'fkProfile');
        if($this->isRegistered($params))
            return $this->update($params);

        return $this->insert($params);
    }

    private function isRegistered($params)
    {
        $result = $this->getEm()->createQueryBuilder()
                ->from('Data\Entity\Acl\UserProfile', 't')
                ->select('COUNT(t) as rows')
                ->where('t.fkUser=:fkUser', 't.fkProfile=:fkProfile')
                ->setParameters($params)->getQuery()->getOneOrNullResult();

        return $result ? current($result) > 0 : null;
    }

    public function clearRows($fkUser)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Acl\UserProfile', 't')
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
            ->update('Data\Entity\Acl\UserProfile', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkUser=:fkUser', 't.fkProfile=:fkProfile')
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
        $entity = new \Data\Entity\Acl\UserProfile();
        $entity->persist($params);
        return $entity;
    }

}
