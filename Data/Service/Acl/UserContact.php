<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;

/**
 * Description of UserContact
 *
 * @author moysesoliveira
 */
class UserContact extends AbstractService {
    
    public function saveCollection(int $fkUser, array $collection)
    {
        $this->clearRows($fkUser);
        foreach($collection as $data)
            $this->saveRow($data['id'], $fkUser, $data['fkContactMode'], $data['vrcContact']);
    }

    private function saveRow($id, $fkUser, $fkContactMode, $vrcContact)
    {
        $entity = new \Data\Entity\Acl\UserContact();
        if(!!$id)
            $entity = $entity->load($id);
        
        $entity->setDttDeleted(null);
        $entity->setFkUser($fkUser);
        $entity->setFkContactMode($fkContactMode);
        $entity->setVrcContact($vrcContact);
        $entity->persist([]);
    }

    public function clearRows($fkUser)
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Acl\UserContact', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkUser=:fkUser')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkUser', $fkUser)
            ->getQuery()->execute();
        return true;
    }

}
