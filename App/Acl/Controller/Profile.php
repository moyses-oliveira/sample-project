<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

class Profile extends AbstractController {

    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Acl\Profile */
        $repository = $this->getEm()->getRepository('\Data\Entity\Acl\Profile');
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
        $entity = (new \Data\Entity\Acl\Profile)->load($pk);
        if(!$entity)
            return $this->error('Page can\'t be found!', 404);

        return $this->form($entity->toArray());
    }

    private function form($data = [])
    {
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');

        /* @var $repository \Data\Repository\Acl\ProfileModule */
        $repository = $this->getEm()->getRepository('\Data\Entity\Acl\ProfileModule');
        $modules = $repository->getOptions();
        $modulesEnabled = $repository->getValues($data['id'] ?? '');

        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'modules', 'modulesEnabled', 'saved'));
    }

    public function save(?string $pk = null)
    {
        $entity = new \Data\Entity\Acl\Profile();
        if(!!$pk && !$entity->load($pk))
            return $this->json403();

        $response = (new \Data\Service\Acl\Profile())->save($entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

}
