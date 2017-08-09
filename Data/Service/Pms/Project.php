<?php

namespace Data\Service\Pms;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;
use Spell\Server\Session;

/**
 * Service save pms_project
 *
 * @author moysesoliveira
 */
class Project extends AbstractService {

    /**
     * 
     * @param EntryCollectionInterface $inspector
     * @param \Data\Entity\Pms\Project $entity
     * @param array $input
     * @return array
     */
    public function save(EntryCollectionInterface $inspector, \Data\Entity\Pms\Project $entity, array $input): array
    {
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        
        if(!isset($GLOBALS['user']))
            throw new \Exception('No user are logged in.');


        if($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;
        
        if(!$entity->getId()):
            $entity->setFkUser($GLOBALS['user']['id']);
            $entity->setDttStarted(new \DateTime);
        endif;
        
        if($success)
            $entity->persist($inspector->normalize($input));

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    public function isRepeated($id, array $input)
    {
        /* @var $repository \Data\Repository\Pms\Project */
        $repository = $this->getRepository('Data\Entity\Pms\Project');
        return $repository->isRepeated($id, $input['vrcName'], $input['vrcAlias']);
    }

}
