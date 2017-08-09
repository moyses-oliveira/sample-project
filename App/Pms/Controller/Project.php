<?php

namespace App\Pms\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

class Project extends AbstractController {

    public $isPublic = false;

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

    public function follow(string $alias)
    {
        $this->getTheme()->addCss('library/trumbowyg/ui/trumbowyg.min.css');
        $this->getTheme()->addCss('library/timeline/timeline.css');
        $this->getTheme()->addJs('library/trumbowyg/trumbowyg.min.js');
        $this->getTheme()->addJs('library/trumbowyg/plugins/upload/trumbowyg.upload.min.js');
        $this->getTheme()->addJs('library/trumbowyg/trumbowyg.bootstrap.js');

        /* @var $repository \Data\Repository\Pms\Post */
        $repository = $this->getEm()->getRepository('\Data\Entity\Pms\Post');

        $posts = $repository->getAll($alias);
        $project = $this->getProject($alias);
        $this->getView()->setFile('follow.php');
        $action = Route::link(Route::getModule(), 'post', $alias);
        $sbtt = Localization::T(__CLASS__ . '::FOLLOW');
        $this->setSubtitle($sbtt . ' - ' . $project->getVrcName());
        return $this->render(compact('project', 'action', 'posts'));
    }

    public function post(string $alias, ?string $pk = null)
    {
        $inspector = new \Data\Inspector\Pms\Post();
        $project = $this->getProject($alias);
        $entity = new \Data\Entity\Pms\Post();
        $entity->setFkProject($project->getId());
        if(!$entity)
            return $this->json403();

        $response = (new \Data\Service\Pms\Post())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'follow', $alias);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

    public function uploadWysiwyg()
    {
        if(!isset($_FILES['image']))
            return $this->json403(['']);

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = md5(uniqid()) . ".$ext";
        $path = ['Public', 'upload', 'pms', 'wysiwyg', $filename];
        $destination = implode(DIRECTORY_SEPARATOR, array_merge([Route::getPath()], $path));
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        $src = Route::getServerName() . Route::getRoot() . Path::combine($path, '/');
        $response = [
            'data' => compact('src'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }

    private function getProject($alias): \Data\Entity\Pms\Project
    {
        /* @var $repository \Data\Repository\Pms\Project */
        $repository = $this->getEm()->getRepository('\Data\Entity\Pms\Project');
        return $repository->getByAlias($alias);
    }

}
