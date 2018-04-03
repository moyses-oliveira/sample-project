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
class UserEmployee extends AbstractService {

    /**
     * 
     * @param \Data\Inspector\Acl\User $inspector
     * @param \Data\Entity\Acl\User $entity
     * @param array $input
     * @return type
     */
    public function save(\Data\Entity\Acl\User $entity, array $input)
    {
        $userService = new User();
        $userSave =  $userService->save($entity, $input);
        $this->saveEmployee($userSave['data']['id'], $input);
        return $userSave;
    }



    public function saveEmployee(int $fkUser, array $input): \Data\Entity\Acl\UserEmployee
    {
        $_entity = $this->getEm()->getRepository(\Data\Entity\Acl\UserEmployee::class)->findOneBy(compact('fkUser'));
        /* @var $entity \Data\Entity\Acl\UserEmployee */
        $entity = $_entity ? $_entity : new \Data\Entity\Acl\UserEmployee();
        $entity->setFkUser($fkUser);
        $entity->setFkAuthority(!$input['fkAuthority'] ? null : intval($input['fkAuthority']));
        $entity->setTnyCommercial($input['tnyCommercial'] ?? '0');
        $entity->persist([]);
        return $entity;
    }

}
