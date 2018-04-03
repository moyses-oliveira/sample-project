<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
use Data\Service\File\Gallery;

class Me extends AbstractController {
    use Extension\Wysiwyg;

    protected $isAuth = false;

    public function password()
    {
        $action = Route::link(Route::getModule(), 'ch-password');
        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        $this->getTheme()->addJs('library/spell/js/Input/PasswordConfirm.js');
        return $this->render(compact('action', 'saved'));
    }

    public function chPassword()
    {
        $inspector = new \Data\Inspector\Acl\User();
        $user = (new \Data\Entity\Acl\User())->load($GLOBALS['user']['id']);

        $errors = [];
        if($user->getVrbPass() !== $inspector->hash($user->getVrcEmail(), $_POST['vrcCurrent']))
            $errors = ['vrcCurrent' => 'INVALID_PASSWORD'];

        $success = count($errors) < 1;
        $data = [];
        $response = compact('success', 'errors', 'data');
        if(!$errors):
            $user->setVrbPass($inspector->hash($user->getVrcEmail(), $_POST['vrcNew']));
            $user->persist([]);
            $response['redirect'] = Route::link(Route::getModule(), 'password');
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');
        endif;

        return $this->json($response);
    }
    
    public function update() {
        
        $this->setSubtitle(Localization::T('SUBTITLE_UPDATE'));
        $entity = (new \Data\Entity\Acl\User)->load($GLOBALS['user']['id']);
        if (!$entity)
            return $this->e404('Page can\'t be found!');

        $data = $entity->toArray();
        $theme = $this->getTheme();
        $theme->addCss('library/fileupload/jquery.fileupload.css');
        $theme->addJs('library/fileupload/jquery.ui.widget.js');
        $theme->addJs('library/fileupload/jquery.fileupload.js');
        $theme->addJs('application/acl/user/contact.js');
        $theme->addJs('application/acl/user/contactItem.js');
        $theme->addJs('application/acl/user/avatar.js');
        $action = Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');

        $contactMode = $this->getEm()->getRepository(\Data\Entity\Acl\UserContactMode::class)->options();
        $collection = $this->getEm()->getRepository(\Data\Entity\Acl\UserContact::class)->options($data['id'] ?? '');

        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'contactMode', 'collection', 'saved'));
    }

    public function save()
    {
        $response = (new \Data\Service\Acl\Me())->save($_POST, $GLOBALS['user']['id']);

        if (!$response['success'])
            return $this->json($response, 200);

        $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');
        $response['redirect'] = Route::link(Route::getModule(), 'update');

        return $this->json($response, 200);
    }

    public function uploadImage()
    {
        if (!isset($_FILES['avatar']))
            return $this->json403();

        $attach = $_FILES['avatar'];
        $name = $attach['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        if (!in_array(strtolower($ext), ['jpg', 'png', 'bmp', 'gif', 'jpeg']))
            return $this->json400(['Invalid file type.']);

        $alt = $title = pathinfo($name, PATHINFO_FILENAME);
        $gallery = new Gallery(['Public', 'upload', 'acl', 'user']);
        $gallery->addSize('icon', 50, 50, true);
        $gallery->addSize('thumb', 150, 150, true);
        $src = $gallery->upload($attach, 600, 600);
        $summary = '';
        $response = [
            'data' => compact('src', 'name', 'ext', 'alt', 'title', 'summary'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }

}
