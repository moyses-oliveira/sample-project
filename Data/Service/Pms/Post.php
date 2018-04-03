<?php

namespace Data\Service\Pms;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service save pms_post
 *
 * @author moysesoliveira
 */
class Post extends AbstractService {

    /**
     * 
     * @param EntryCollectionInterface $inspector
     * @param \Data\Entity\Pms\Project $entity
     * @param array $input
     * @return array
     */
    public function save(EntryCollectionInterface $inspector, \Data\Entity\Pms\Post $entity, array $input): array
    {
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        
        if(!isset($GLOBALS['user']))
            throw new \Exception('No user are logged in.');

        if(!isset($input['enmType']))
            $entity->setChrType('TEXT');
        
        if(!$entity->getId()):
            $entity->setFkUser($GLOBALS['user']['id']);
            $entity->setDttCreated(new \DateTime);
            $entity->setDttUpdated(new \DateTime);
        endif;
        
        if($success)
            $entity->persist($inspector->normalize($input));

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

}
