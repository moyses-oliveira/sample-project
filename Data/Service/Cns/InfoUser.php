<?php

namespace Data\Service\Cns;

use Spell\Data\Doctrine\AbstractService;

/**
 * Service save cns_info_user
 *
 * @author moysesoliveira
 */
class InfoUser extends AbstractService {

    public function saveCollection($fkInfo, array $collection)
    {
        $this->clearRows($fkInfo);
        foreach($collection as $fkUser)
            $this->saveRow($fkInfo, $fkUser);
    }

    private function saveRow($fkInfo, $fkUser)
    {
        $params = compact('fkInfo', 'fkUser');
        if($this->isRegistered($params))
            return $this->update($params);

        return $this->insert($params);
    }

    private function isRegistered($params)
    {
        $result = $this->getEm()->createQueryBuilder()
                ->from('Data\Entity\Cns\InfoUser', 't')
                ->select('COUNT(t) as rows')
                ->where('t.fkInfo=:fkInfo', 't.fkUser=:fkUser')
                ->setParameters($params)->getQuery()->getOneOrNullResult();

        return $result ? current($result) > 0 : null;
    }

    public function clearRows($fkInfo)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Cns\InfoUser', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkInfo=:fkInfo')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkInfo', $fkInfo)
            ->getQuery()->execute();
        return true;
    }

    private function update($params)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Cns\InfoUser', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkInfo=:fkInfo', 't.fkUser=:fkUser')
            ->setParameters($params)
            ->setParameter('dttDeleted', null)
            ->getQuery()->execute();
        return true;
    }

    public function acceptMessage($fkInfo, $fkUser)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Cns\InfoUser', 't')
            ->set('t.dttChecked', ':dttChecked')
            ->where('t.fkInfo=:fkInfo', 't.fkUser=:fkUser')
            ->setParameters(compact('fkInfo', 'fkUser'))
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
        $entity = new \Data\Entity\Cns\InfoUser();
        $entity->persist($params);
        return $entity;
    }

}
