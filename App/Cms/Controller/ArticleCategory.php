<?php

namespace App\Cms\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;

class ArticleCategory extends AbstractController {

    public $isPublic = true;

    public function index()
    {
        $groupOptions = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleGroup')->options();
        return $this->render(compact('groupOptions'));
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Cms\ArticleCategory */
        $repository = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleCategory');
        return $this->json($repository->loadData($_GET));
    }

    public function create()
    {
        return $this->form();
    }

    public function update($pk)
    {
        $entity = (new \Data\Entity\Cms\ArticleCategory)->load($pk);
        if(!$entity)
            return $this->error('Page can\'t be found!', 404);

        return $this->form($entity->toArray());
    }

    private function form($data = [])
    {
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');
        $groupOptions = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleGroup')->options();
        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'saved', 'groupOptions'));
    }

    public function save(?string $pk = null)
    {
        $inspector = new \Data\Inspector\Cms\ArticleCategory();
        $entity = (new \Data\Entity\Cms\ArticleCategory)->load($pk);
        if(!$entity)
            return $this->json403();

        $response = (new \Data\Service\Cms\ArticleCategory())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

}
