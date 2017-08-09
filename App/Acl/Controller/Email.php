<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\Flash\Path;
use Spell\MVC\Flash\Route;
use Data\Service\Notification;
use Spell\UI\Layout\View;
use Spell\Flash\SMTP;

class Email extends AbstractController {

    public $isPublic = true;

    public function index()
    {
        try {
            $viewPath = Path::combine([Route::getPath() , 'App', 'Acl', 'Theme', 'notification']);
            $view = new View($viewPath, 'sample.php');
            $notification = new Notification($view, 'Sistema');
            $notification->addTo('moyses.oliveira@madeiramadeira.com.br', 'MFLPO');
            $notification->submit('Mensagem de teste');
            return $this->json(['success' => true, 'message' => 'success']);
        } catch(\Exception $e) {
            var_dump($e->getMessage());die;
            return $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
