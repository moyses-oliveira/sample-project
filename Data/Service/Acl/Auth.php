<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Path;
use Spell\MVC\Flash\Route;

/**
 * Service Auth
 *
 * @author moysesoliveira
 */
class Auth extends AbstractService {
    
    public function login($email, $pass) {
        $auth = $this->getAuthRepository();
        $fkUser = $auth->login($email, $pass);
        $success = is_numeric($fkUser);
        $errors = $success ? [] : ['GLOBAL' => \Spell\Flash\Localization::T('Auth\Login\Error::Login')];
        $data = [];
        if($success):
            list($data['auth'], $data['acl']) = $auth->getSessionParams($fkUser);
            $data['profiles'] = $auth->getProfiles($fkUser);
            $data['user'] = $auth->getUserById($fkUser);
        endif;
        return compact('errors', 'success', 'data');
    }

    private function getAuthRepository(): \Data\Repository\Acl\Auth
    {
        return $this->getRepository('Data\Entity\Acl\Auth');
    }
    
    public function recover(string $vrcEmail) {
        /* @var $entity \Data\Entity\Acl\User */
        $entity = $this->getUserRepository()->getByEmail($vrcEmail);
        $inspector = new \Data\Inspector\Acl\User();
        $data = [];
        $success = true;
        if(!$entity):
            $success = false;
            $errors = $success ? [] : ['vrcEmail' => \Spell\Flash\Localization::T('Auth\Login\Error::INVALID')];
            return compact('errors', 'success', 'data');
        endif;
            
        $pass = substr(md5('random' . uniqid()), 0, 8);
        $entity->setVrbPass($inspector->hash($entity->getVrcEmail(), $pass));
        $this->getEm()->persist($entity);
        $this->getEm()->flush();
        $this->notifyRecover(['pass' => $pass], $entity);
        return compact('errors', 'success', 'data');
    }
    
    public function notifyRecover(array $data, \Data\Entity\Acl\User $entity) {
        $path = Path::combine([Route::getPath(), 'App', 'Acl', 'View', 'Auth']);
        $data['user'] = $entity;
        $view = new \Spell\UI\Layout\View($path, 'notify-recover.php', $data);
        $notification = new \Data\Service\Notification($view, 'Sistema');
        $notification->addTo($entity->getVrcEmail(), $entity->getVrcName());
        $notification->submit('Recuperação de senha | admin.akitemcarro.com.br');
    }
    
    public function getUserRepository(): \Data\Repository\Acl\User {
            
        return $this->getEm()->getRepository(\Data\Entity\Acl\User::class);
    }
}
