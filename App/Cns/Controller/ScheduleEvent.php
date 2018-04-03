<?php

namespace App\Cns\Controller;

use App\Acl\Controller\AbstractController;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;

/**
 * Schedule Event Controller
 *
 * @author moyses-oliveira
 */
class ScheduleEvent extends AbstractController {

    public function index()
    {
        $theme = $this->getTheme();
        $theme->addCss('library/fullcalendar/css/fullcalendar.min.css');
        $theme->addJs('library/fullcalendar/js/moment.min.js');
        $theme->addJs('library/fullcalendar/js/fullcalendar.min.js');
        $theme->addJs('library/fullcalendar/locale/pt-br.js');
        $theme->addJs('application/cns/js/ScheduleEvent.js');
        $categories = $this->getEm()->getRepository(\Data\Entity\Cns\ScheduleCategory::class)->options();
        return $this->render(compact('categories'));
    }

    public function data()
    {
        /* @var $repository \Data\Repository\Cns\ScheduleEvent */
        $repository = $this->getEm()->getRepository(\Data\Entity\Cns\ScheduleEvent::class);
        $collection = $repository->data($_GET);
        foreach($collection as &$data)
            $data['url'] = Route::link (Route::getModule(), 'update', $data['id']);
        
        return $this->json($collection);
    }

    public function create()
    {
        $this->setSubtitle(Localization::T('SUBTITLE_CREATE'));
        return $this->form();
    }

    public function update($pk)
    {
        $this->setSubtitle(Localization::T('SUBTITLE_UPDATE'));
        $entity = (new \Data\Entity\Cns\ScheduleEvent)->load($pk);
        if (!$entity)
            return $this->error('Page can\'t be found!', 404);

        $data = $entity->toArray();
        return $this->form($data);
    }

    private function form($data = [])
    {
        $theme = $this->getTheme();
        $theme->addCss('library/datetimepicker/bootstrap-datetimepicker.css');
        $theme->addJs('library/datetimepicker/moment-with-locales.js');
        $theme->addJs('library/datetimepicker/bootstrap-datetimepicker.js');
        #$theme->addCss('library/adminto/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css');
        #$theme->addJs('library/adminto/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
        #$theme->addJs('library/adminto/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js');

        $action = Route::link(Route::getModule(), 'save') . (isset($data['id']) ? '/' . $data['id'] : '');
        $saved = $this->getSessionMessage(__CLASS__ . '::saved');
        $categories = $this->getEm()->getRepository(\Data\Entity\Cns\ScheduleCategory::class)->options();
        $this->getView()->setFile('form.php');
        return $this->render(compact('data', 'action', 'saved', 'categories'));
    }

    public function save(?string $pk = null)
    {
        $entity = new \Data\Entity\Cns\ScheduleEvent();
        if(!!$pk && !$entity->load($pk))
            return $this->json403();

        $_POST['fkUser'] = $GLOBALS['user']['id'];
        $response = (new \Data\Service\Cns\ScheduleEvent())->save($entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

}
