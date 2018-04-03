<?php

namespace App\Cms\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;

class ArticleGroup extends AbstractController {

    public function index()
    {
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Cms\ArticleGroup */
        $repository = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleGroup');
        $results = $repository->loadData($_GET);

        return $this->json($results);
    }

    public function create()
    {
        return $this->form();
    }

    public function update($pk)
    {
        $entity = (new \Data\Entity\Cms\ArticleGroup)->load($pk);
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
        $inspector = new \Data\Inspector\Cms\ArticleGroup();
        $entity = new \Data\Entity\Cms\ArticleGroup();
        if(!!$pk && !$entity->load($pk))
            return $this->json403();

        $response = (new \Data\Service\Cms\ArticleGroup())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

}
