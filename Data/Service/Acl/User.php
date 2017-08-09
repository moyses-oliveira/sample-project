<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service save acl_app
 *
 * @author moysesoliveira
 */
class User extends AbstractService {

    /**
     * 
     * @param \Data\Inspector\Acl\User $inspector
     * @param \Data\Entity\Acl\User $entity
     * @param array $input
     * @return type
     */
    public function save(\Data\Inspector\Acl\User $inspector, \Data\Entity\Acl\User $entity, array $input)
    {
        if(!$entity->getId()):
            $pass = substr(md5('random' . uniqid()), 0, 8);
            $entity->setVrbPass($inspector->hash($input['vrcEmail'] ?? '', $pass));
            $entity->setVrcToken(hash('sha256', $input['vrcEmail'] . $entity->getVrbPass()));
            $entity->setDttAdded(new \DateTime());
        endif;
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();

        if($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;
        
        if($success)
            $entity->persist($inspector->normalize($input));

        $profileModule = new \Data\Service\Acl\UserProfile();
        $profileModule->saveCollection($entity->getId(), $input['profiles'] ?? []);
        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    public function isRepeated($id, array $input)
    {
        /* @var $repository \Data\Repository\Acl\User */
        $repository = $this->getRepository('Data\Entity\Acl\User');
        return $repository->isRepeated($id, $input['vrcEmail']);
    }

}
