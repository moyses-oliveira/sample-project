<?php

namespace App\Acl\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

class Category extends AbstractController {

    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Acl\Category */
        $repository = $this->getEm()->getRepository('\Data\Entity\Acl\Category');
        $results = $repository->loadData($_GET);
        foreach($results['data'] as &$data)
            $data['vrcIcon'] = sprintf('<i class="fa %s"></i>', $data['vrcIcon']);

        return $this->json($results);
    }

    public function create()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_CREATE'));
        return $this->form();
    }

    public function update($pk)
    {
        $this->setSubtitle(Localization::T('SUBTITLE_UPDATE'));
        $entity = (new \Data\Entity\Acl\Category)->load($pk);
        if(!$entity)
            return $this->error('Page can\'t be found!', 404);

        return $this->form($entity->toArray());
    }

    private function form($data = [])
    {
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');
        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'saved'));
    }

    public function save(?string $pk = null)
    {
        $inspector = new \Data\Inspector\Acl\Category();
        $entity = (new \Data\Entity\Acl\Category)->load($pk);
        if(!$entity)
            return $this->json403();

        $response = (new \Data\Service\Acl\Category())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

}
