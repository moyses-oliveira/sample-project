<?php

namespace Data\Service\Cns;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service save cns_info_reply
 *
 * @author moysesoliveira
 */
class TaskReply extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Cns\TaskReply $entity
     * @param array $input
     * @return type
     */
    public function save(\Data\Entity\Cns\TaskReply $entity, array $input)
    {
        $inspector = new \Data\Inspector\Cns\TaskReply();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        if(!$entity->getId())
            $entity->setDttPosted(new \DateTime());
        
        if($success)
            $entity->persist($inspector->normalize($input));

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

}
