<?php
namespace App\Cns\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

class Info extends AbstractController {
    
    public function __settings()
    {
        $this->isAuth = false;
        $this->setTitle(Localization::T(__CLASS__ . '::TITLE'));
    }

    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Cns\Info */
        $repository = $this->getEm()->getRepository('\Data\Entity\Cns\Info');
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
        $entity = (new \Data\Entity\Cns\Info)->load($pk);
        if(!$entity)
            return $this->error('Page can\'t be found!', 404);

        return $this->form($entity->toArray());
    }

    private function form($data = [])
    {
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');

        /* @var $repository \Data\Repository\Cns\InfoUser */
        $repository = $this->getEm()->getRepository('\Data\Entity\Cns\InfoUser');
        $users = $repository->getOptions();
        $usersEnabled = $repository->getValues($data['id'] ?? '');

        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'users', 'usersEnabled', 'saved'));
    }

    public function save(?string $pk = null)
    {
        $inspector = new \Data\Inspector\Cns\Info();
        $entity = (new \Data\Entity\Cns\Info)->load($pk);
        if(!$entity)
            return $this->json403();

        $response = (new \Data\Service\Cns\Info())->save($inspector, $entity, $_POST, $_POST['users']);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

    public function loadMessages()
    {
        global $user;
        /* @var $repository \Data\Repository\Cns\InfoUser */
        $repository = $this->getEm()->getRepository('\Data\Entity\Cns\InfoUser');
        $response = $repository->getNewMessagesByUser($user['id']);
        
        return $this->json($response, 200);
    }

    public function acceptMessage($id)
    {
        global $user;
        $service = new \Data\Service\Cns\InfoUser();
        $response = $service->acceptMessage($id, $user['id']);
        return $this->json($response, 200);
    }
    
}
