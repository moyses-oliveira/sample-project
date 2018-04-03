<?php

namespace App\Cns\Controller;

use App\Acl\Controller\AbstractController;

/**
 * Description of Support
 *
 * @author moyses-oliveira
 */
class Task extends AbstractController {

    public function __settings()
    {
        $this->isAuth = false;
        parent::__settings();
    }

    public function loadMessages()
    {
        global $user;
        /* @var $repository \Data\Repository\Cns\TaskUser */
        $repository = $this->getEm()->getRepository(\Data\Entity\Cns\TaskUser::class);
        $response = $repository->getNewMessagesByUser($user['id'], 'TASK');

        return $this->json($response, 200);
    }

}
