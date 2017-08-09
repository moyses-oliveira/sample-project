<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;

/**
 * Description of ProfileModule
 *
 * @author moysesoliveira
 */
class ProfileModule extends AbstractService {

    /**
     *
     * @var type 
     */
    private $modules = [];

    /**
     *
     * @var \Data\Entity\Acl\ProfileModule
     */
    protected $entity = null;


    public function saveCollection($fkProfile, array $collection)
    {
        $this->clearRows($fkProfile);
        foreach($collection as $fkModule)
            $this->saveRow($fkProfile, $fkModule);
    }

    private function saveRow($fkProfile, $fkModule)
    {
        $params = compact('fkProfile', 'fkModule');
        if($this->isRegistered($params))
            return $this->update($params);

        return $this->insert($params);
    }

    private function isRegistered($params)
    {
        $result = $this->getEm()->createQueryBuilder()
                ->from('Data\Entity\Acl\ProfileModule', 't')
                ->select('COUNT(t) as rows')
                ->where('t.fkProfile=:fkProfile', 't.fkModule=:fkModule')
                ->setParameters($params)->getQuery()->getOneOrNullResult();

        return $result ? current($result) > 0 : null;
    }

    public function clearRows($fkProfile)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Acl\ProfileModule', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkProfile=:fkProfile')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkProfile', $fkProfile)
            ->getQuery()->execute();
        return true;
    }

    private function update($params)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Acl\ProfileModule', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkProfile=:fkProfile', 't.fkModule=:fkModule')
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
        $entity = new \Data\Entity\Acl\ProfileModule();
        $entity->persist($params);
        return $entity;
    }

}
