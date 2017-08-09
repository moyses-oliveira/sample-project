<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
use Data\Service\File\Gallery;

class User extends AbstractController {

    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Acl\User */
        $repository = $this->getEm()->getRepository('\Data\Entity\Acl\User');
        return $this->json($repository->loadData($_GET));
    }

    public function create()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_CREATE'));
        return $this->form();
    }

    public function update($pk)
    {
        $this->setSubtitle(Localization::T('SUBTITLE_UPDATE'));
        $entity = (new \Data\Entity\Acl\User)->load($pk);
        if(!$entity)
            return $this->e404('Page can\'t be found!');

        return $this->form($entity->toArray());
    }

    private function form($data = [])
    {
        $theme = $this->getTheme();
        $theme->addCss('library/fileupload/jquery.fileupload.css');
        $theme->addJs('library/fileupload/jquery.ui.widget.js');
        $theme->addJs('library/fileupload/jquery.fileupload.js');
        $theme->addJs('application/acl/user/avatar.js');
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');

        /* @var $repository \Data\Repository\Acl\UserProfile */
        $repository = $this->getEm()->getRepository('\Data\Entity\Acl\UserProfile');
        $profiles = $repository->getOptions();
        $profilesEnabled = $repository->getValues($data['id'] ?? '');

        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'profiles', 'profilesEnabled', 'saved'));
    }

    public function save(?string $pk = null)
    {
        $inspector = new \Data\Inspector\Acl\User();
        $entity = (new \Data\Entity\Acl\User)->load($pk);
        if(!$entity)
            return $this->json403();

        $response = (new \Data\Service\Acl\User())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }
    
    public function uploadImage() {
        if(!isset($_FILES['avatar']))
            return $this->json403();

        $attach = $_FILES['avatar'];
        $name = $attach['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        if(!in_array(strtolower($ext), ['jpg', 'png', 'bmp', 'gif', 'jpeg']))
            return $this->json400(['Invalid file type.']);

        $alt = $title = pathinfo($name, PATHINFO_FILENAME);
        $gallery = new Gallery(['Public', 'upload', 'acl', 'user']);
        $gallery->addSize('icon', 50, 50, true);
        $src = $gallery->upload($attach, 150, 150);
        $summary = '';
        $response = [
            'data' => compact('src', 'name', 'ext', 'alt', 'title', 'summary'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }

}
