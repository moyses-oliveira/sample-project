<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\UI\HTML\Tag;
use App\UI\Breadcrumb;

class Auth extends AbstractController {

    public $isPublic = true;

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $this->setTitle('Home');
        $this->getBreadcrumb(true)->add(Tag::mk('i', 'fa fa-home')->render() . ' &nbsp;Home');
        $this->getView()->setFile('dashboard.php');
        return $this->render();
    }

    public function login()
    {
        $this->setTitle('Login');
        $this->getTheme()->setFile('auth.php');
        $this->getView()->setFile('login.php');
        return $this->render();
    }

    #contato@moysesoliveira.com.br
    #asdassda

    public function logon()
    {
        $service = new \Data\Service\Acl\Auth();
        $data = $service->login($_REQUEST['email'], $_REQUEST['pass']);
        $this->getSession()->setParams($data['data']);
        if($data['success'])
            $data['redirect'] = Route::link(Route::getModule(), 'dashboard');

        return $this->json($data, 200);
    }

    public function logout()
    {
        $this->getSession()->destroy();
        $this->mkLogin();
    }

}
