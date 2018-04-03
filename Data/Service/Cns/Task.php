<?php

namespace Data\Service\Cns;

use Spell\Data\Doctrine\AbstractService;

/**
 * Service save cns_info
 *
 * @author moysesoliveira
 */
class Task extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Cns\Task $entity
     * @param array $input
     * @param array $users
     * @return type
     */
    public function save(\Data\Entity\Cns\Task $entity, array $input, array $users)
    {
        $inspector = new \Data\Inspector\Cns\Task();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        
        if(!$entity->getId())
            $entity->setDttPosted(new \DateTime);
            
        if($success)
            $entity->persist($inspector->normalize());

        $infoUser = new \Data\Service\Cns\TaskUser();
        $infoUser->saveCollection($entity->getId(), $users);
        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }
    
    public function finishTask(int $fkTask, int $fkUser) {
        
        /* @var $entity \Data\Entity\Cns\Task */
        $entity = (new \Data\Entity\Cns\Task())->load($fkTask);
        $entity->setDttFinished(new \DateTime());
        $entity->persist([]);
        
        $infoReply = new \Data\Entity\Cns\TaskReply();
        $infoReply->setDttPosted(new \DateTime());
        $infoReply->setFkUser($fkUser);
        $infoReply->setFkTask($fkTask);
        $infoReply->setVrcReply('Atividade finalizada.');
        $infoReply->persist([]);
        
        $infoUser = new \Data\Service\Cns\TaskUser();
        $infoUser->checkRows($entity->getId());
    }

}
