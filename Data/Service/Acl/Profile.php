<?php

namespace Data\Service\Acl;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service save acl_app
 *
 * @author moysesoliveira
 */
class Profile extends AbstractService {

    /**
     * 
     * @param type $data
     * @param type $pk
     * @return type
     * @throws \Entity
     */
    public function save(EntryCollectionInterface $inspector, \Data\Entity\Acl\Profile $entity, array $input)
    {
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();

        if($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;
        
        if($success)
            $entity->persist($inspector->normalize($input));

        $profileModule = new \Data\Service\Acl\ProfileModule();
        $profileModule->saveCollection($entity->getId(), $input['modules'] ?? []);
        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    public function isRepeated($id, array $input)
    {
        /* @var $repository \Data\Repository\Acl\Profile */
        $repository = $this->getRepository('Data\Entity\Acl\Profile');
        return $repository->isRepeated($id, $input['vrcName'], $input['vrcAlias']);
    }

}
