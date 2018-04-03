<?php

namespace App\Cns\Controller;

use App\Acl\Controller\AbstractController;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;

/**
 * Schedule Category Controller
 *
 * @author moyses-oliveira
 */
class ScheduleCategory extends AbstractController {
    
    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Cns\ScheduleCategory */
        $repository = $this->getEm()->getRepository(\Data\Entity\Cns\ScheduleCategory::class);
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
        $entity = new \Data\Entity\Cns\ScheduleCategory();
        if(!$entity->load($pk))
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
        $entity = new \Data\Entity\Cns\ScheduleCategory();
        if(!!$pk && !$entity->load($pk))
            return $this->json403();

        $response = (new \Data\Service\Cns\ScheduleCategory())->save($entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }
 
    
    
}
