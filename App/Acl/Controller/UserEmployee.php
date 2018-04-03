<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
use Data\Service\File\Gallery;

class UserEmployee extends AbstractController {

    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Acl\UserEmployee */
        $repository = $this->getEm()->getRepository('\Data\Entity\Acl\UserEmployee');
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
        if (!$entity)
            return $this->e404('Page can\'t be found!');

        return $this->form($entity->toArray());
    }

    private function form($data = [])
    {
        $theme = $this->getTheme();
        $theme->addCss('library/fileupload/jquery.fileupload.css');
        $theme->addJs('library/fileupload/jquery.ui.widget.js');
        $theme->addJs('library/fileupload/jquery.fileupload.js');
        $theme->addJs('application/acl/user/contact.js');
        $theme->addJs('application/acl/user/contactItem.js');
        $theme->addJs('application/acl/user/avatar.js');

        /* @var $userEmplyee \Data\Entity\Acl\UserEmployee */
        $action = Route::link(Route::getModule(), 'save');
        $userEmplyee = new \Data\Entity\Acl\UserEmployee();
        $tnyCommercial = false;
        if (isset($data['id'])):
            $action = Route::link(Route::getModule(), 'save', $data['id']);
            $userEmplyee = $this->getEm()->getRepository(\Data\Entity\Acl\UserEmployee::class)->findOneBy(['fkUser' => $data['id']]);
            $data['fkAuthority'] = $userEmplyee->getFkAuthority();
            $tnyCommercial = $userEmplyee->getTnyCommercial() > 0;
        endif;

        $authorityOptions = $this->getEm()->getRepository(\Data\Entity\Acl\UserEmployee::class)->options($data['id'] ?? '0');
        $this->getView()->setFile('form.php');

        /* @var $profileRepository \Data\Repository\Acl\UserProfile */
        $profileRepository = $this->getEm()->getRepository(\Data\Entity\Acl\UserProfile::class);
        $profiles = $profileRepository->getOptions();
        $profilesEnabled = $profileRepository->getValues($data['id'] ?? '');

        /* @var $groupRepository \Data\Repository\Acl\UserGroup */
        $groupRepository = $this->getEm()->getRepository(\Data\Entity\Acl\UserGroup::class);
        $groups = $groupRepository->getOptions();
        $groupsEnabled = $groupRepository->getValues($data['id'] ?? '');
        
        
        $contactMode = $this->getEm()->getRepository(\Data\Entity\Acl\UserContactMode::class)->options();
        $collection = $this->getEm()->getRepository(\Data\Entity\Acl\UserContact::class)->options($data['id'] ?? '');

        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'profiles', 'profilesEnabled', 'groups', 'groupsEnabled', 'contactMode', 'collection', 'saved', 'authorityOptions', 'tnyCommercial'));
    }

    public function save(?string $pk = null)
    {
        $entity = !$pk ? new \Data\Entity\Acl\User() : (new \Data\Entity\Acl\User())->load($pk);
        if (!!$pk && !$entity->load($pk))
            return $this->json403();

        $response = (new \Data\Service\Acl\UserEmployee())->save($entity, $_POST);

        if (!$response['success'])
            return $this->json($response, 200);

        $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

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
