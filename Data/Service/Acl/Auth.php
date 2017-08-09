<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;

/**
 * Service Auth
 *
 * @author moysesoliveira
 */
class Auth extends AbstractService {
    
    public function login($email, $pass) {
        $auth = $this->getAuthRepository();
        $login = $auth->login($email, $pass);
        $success = is_numeric($login);
        $errors = $success ? [] : ['GLOBAL' => \Spell\Flash\Localization::T('Auth\Login\Error::' . $login)];
        $data = [];
        if($success):
            list($data['auth'], $data['acl']) = $auth->getSessionParams($login);
            $data['user'] = $auth->getUserById($login);
        endif;
        return compact('errors', 'success', 'data');
    }

    private function getAuthRepository(): \Data\Repository\Acl\Auth
    {
        return $this->getRepository('Data\Entity\Acl\Auth');
    }
}
