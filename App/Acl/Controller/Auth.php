<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\UI\HTML\Tag;
use Spell\Flash\Path;
use App\UI\Breadcrumb;

class Auth extends AbstractController {

    public $isPublic = true;

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        if(!($GLOBALS['user'] ?? false))
            return $this->redirect(Route::link(Route::getModule(), 'login'));
        
        $this->setTitle('Home');
        $this->getBreadcrumb(true)->add(Tag::mk('i', 'fa fa-home')->render() . ' &nbsp;Home');
        $this->getView()->setFile('dashboard.php');
        return $this->render();
    }

    public function login()
    {
        $this->setTitle('Login');
        $this->getTheme()->setFile('auth.php');
        $this->getView()->setPath(Path::combine([Route::getPath(), 'App', 'Acl', 'View', 'Auth']));
        $this->getView()->setFile('login.php');
        return $this->render();
    }
    
    public function forgotPassword() {
        $this->setTitle('Esqueceu a Senha');
        $this->getTheme()->setFile('auth.php');
        $this->getView()->setPath(Path::combine([Route::getPath(), 'App', 'Acl', 'View', 'Auth']));
        $this->getView()->setFile('forgot-password.php');
        return $this->render();
    }
    
    public function recoverPassword() {
        
        $response = (new \Data\Service\Acl\Auth())->recover($_POST['vrcEmail']);

        if($response['success'])
            $response['redirect'] = Route::link(Route::getModule(), 'login');
        
        return $this->json($response, 200);
    }

    public function logon()
    {
        if(isset($_POST['validated']))
            $this->redirect(Route::link(Route::getModule(), 'dashboard'));
        
        $service = new \Data\Service\Acl\Auth();
        $data = $service->login($_REQUEST['email'], $_REQUEST['pass']);
        $this->getSession()->setParams($data['data']);
        if($data['success'])
            $data['redirect'] = $GLOBALS['home'] ?? Route::getRoot() . Path::combine(['acl', 'auth', 'dashboard'], '/');

        return $this->json($data, 200);
    }

    public function logout()
    {
        $this->getSession()->destroy();
        $this->mkLogin();
    }

}
