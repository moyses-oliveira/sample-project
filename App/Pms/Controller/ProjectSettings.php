<?php

    namespace App\Pms\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

class ProjectSettings extends AbstractController {

    public $isPublic = true;

    public function index()
    {
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Pms\Project */
        $repository = $this->getEm()->getRepository('\Data\Entity\Pms\Project');
        $results = $repository->loadData($_GET);

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
        $entity = (new \Data\Entity\Pms\Project)->load($pk);
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
        $inspector = new \Data\Inspector\Pms\Project();
        $entity = new \Data\Entity\Pms\Project();
        if(!!$pk && !$entity->load($pk))
            return $this->json403();
        
        $_POST['fkStatus'] = 1;
        $_POST['fkUser'] = $GLOBALS['user']['id'];
        $response = (new \Data\Service\Pms\Project())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

}
