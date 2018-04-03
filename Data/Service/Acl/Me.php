<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;
use Spell\Flash\Path;
use Spell\MVC\Flash\Route;

/**
 * Service save acl_app
 *
 * @author moysesoliveira
 */
class Me extends AbstractService {

    /**
     * 
     * @param array $input
     * @param int $fkUser
     * @return array
     */
    public function save(array $input, int $fkUser): array
    {
        $entity = $this->getEm()->find(\Data\Entity\Acl\User::class, $fkUser);
        $inspector = new \Data\Inspector\Acl\Me();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        
        if ($success):
            $entity->persist($inspector->normalize());

            $userContact = new \Data\Service\Acl\UserContact();
            $userContact->saveCollection($entity->getId(), $input['contact'] ?? []);
        endif;

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

}
