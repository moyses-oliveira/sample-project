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
class User extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Acl\User $entity
     * @param array $input
     * @return array
     */
    public function save(\Data\Entity\Acl\User $entity, array $input): array
    {
        $inspector = new \Data\Inspector\Acl\User();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();

        if (!$entity->getId())
            $this->saveNew($entity, $input);

        if ($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;

        if ($success):
            $entity->persist($inspector->normalize());

            $userProfile = new \Data\Service\Acl\UserProfile();
            $userProfile->saveCollection($entity->getId(), $input['profiles'] ?? []);

            $userContact = new \Data\Service\Acl\UserContact();
            $userContact->saveCollection($entity->getId(), $input['contact'] ?? []);

            $userGroup = new \Data\Service\Acl\UserGroup();
            $userGroup->saveCollection($entity->getId(), $input['groups'] ?? []);
        endif;

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    protected function saveNew(\Data\Entity\Acl\User $entity, array $input)
    {
        $inspector = new \Data\Inspector\Acl\User();
        $vrcEmail = strtolower(trim($input['vrcEmail'] ?? ''));
        $pass = substr(md5('random' . uniqid()), 0, 8);
        $entity->setVrbPass($inspector->hash($vrcEmail, $pass));
        $entity->setVrcToken(hash('sha256', $vrcEmail . $entity->getVrbPass()));
        $entity->setDttAdded(new \DateTime());
        $entity->setVrcEmail($vrcEmail);
        $entity->setVrcName($input['vrcName']);
        $entity->setChrType('default');
        $data['pass'] = $pass;
        $subject = 'Bem vindo ' . $entity->getVrcName() . '!';
        $this->notify('notify-new.php', $data, $entity, $subject);
    }

    public function notify(string $file, array $data, \Data\Entity\Acl\User $entity, string $subject)
    {
        $path = Path::combine([Route::getPath(), 'App', 'Acl', 'View', 'User']);
        $data['user'] = $entity;

        $view = new \Spell\UI\Layout\View($path, $file, $data);
        $notification = new \Data\Service\Notification($view, 'Sistema');
        $notification->addTo($entity->getVrcEmail(), $entity->getVrcName());
        $notification->submit($subject);
    }

    public function isRepeated($id, array $input)
    {
        /* @var $repository \Data\Repository\Acl\User */
        $repository = $this->getRepository(\Data\Entity\Acl\User::class);
        return $repository->isRepeated($id, $input['vrcEmail']);
    }

}
