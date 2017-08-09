<?php

namespace Data\Service\Cns;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;

/**
 * Service save cns_info
 *
 * @author moysesoliveira
 */
class Info extends AbstractService {

    /**
     * 
     * @param type $data
     * @param type $pk
     * @return type
     * @throws \Entity
     */
    public function save(EntryCollectionInterface $inspector, \Data\Entity\Cns\Info $entity, array $input, array $users)
    {
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        if(!$entity->getId())
            $entity->setDttPosted(new \DateTime);
            
        if($success)
            $entity->persist($inspector->normalize($input));

        $infoUser = new \Data\Service\Cns\InfoUser();
        $infoUser->saveCollection($entity->getId(), $users);
        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

}
