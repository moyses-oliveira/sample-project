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
        parent::__settings();
    }

    public function index()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));
        return $this->render();
    }

    public function datatable()
    {
        /* @var $repository \Data\Repository\Cns\Info */
        $repository = $this->getEm()->getRepository(\Data\Entity\Cns\Info::class);
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

    public function view($pk)
    {
        $this->setSubtitle('Visualizar');
        $entity = (new \Data\Entity\Cns\Info)->load($pk);
        if(!$entity)
            return $this->error('Page can\'t be found!', 404);

        return $this->form($entity->toArray(), 'view.php');
    }

    private function form($data = [], $file = 'form.php')
    {
        $theme = $this->getTheme();
        $theme->addJs('application/cns/js/groupSelector.js');
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile($file);

        $levelCollection =  $this->getEm()->getRepository(\Data\Entity\Cns\Level::class)->options();
        
        /* @var $userRepository \Data\Repository\Cns\InfoUser */
        $userRepository = $this->getEm()->getRepository(\Data\Entity\Cns\InfoUser::class);
        
        
        if($file === 'view.php'):
            $users = $userRepository->getActives($data['id']);
        else:
            $users = $userRepository->getOptions();
            $usersEnabled = $userRepository->getValues($data['id'] ?? '');
        endif;
        
        /* @var $groupRepository \Data\Repository\Acl\UserGroup */
        $groupRepository = $this->getEm()->getRepository(\Data\Entity\Acl\UserGroup::class);
        $groups = $groupRepository->getOptions();
        
        $this->getTheme()->getHead()->getUIV()->add('groupRel', $groupRepository->getRel());
        
        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        return $this->render(compact('data', 'action', 'users', 'groups', 'usersEnabled', 'saved', 'levelCollection'));
    }

    public function save(?string $pk = null)
    {
        $inspector = new \Data\Inspector\Cns\Info();
        $entity = new \Data\Entity\Cns\Info();
        if(!!$pk && !$entity->load($pk))
            return $this->json403();

        $_POST['fkUser'] = $GLOBALS['user']['id'];
        $response = (new \Data\Service\Cns\Info())->save($entity, $_POST, $_POST['users']);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

    public function loadMessages()
    {
        global $user;
        /* @var $repository \Data\Repository\Cns\InfoUser */
        $repository = $this->getEm()->getRepository(\Data\Entity\Cns\InfoUser::class);
        $response = $repository->getNewMessagesByUser($user['id']);
        
        return $this->json($response, 200);
    }

    public function loadUrgentMessages() {
        global $user;
        /* @var $repository \Data\Repository\Cns\InfoUser */
        $repository = $this->getEm()->getRepository(\Data\Entity\Cns\InfoUser::class);
        $response = $repository->getNewUrgentMessagesByUser($user['id']);
        
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
