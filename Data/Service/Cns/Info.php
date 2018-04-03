<?php

namespace Data\Service\Cns;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;

/**
 * Service save cns_info
 *
 * @author moysesoliveira
 */
class Info extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Cns\Info $entity
     * @param array $input
     * @param array $users
     * @return type
     */
    public function save(\Data\Entity\Cns\Info $entity, array $input, array $users)
    {
        $inspector = new \Data\Inspector\Cns\Info();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();
        if (!$entity->getId())
            $entity->setDttPosted(new \DateTime);

        $entity->persist($inspector->normalize());

        $infoUser = new \Data\Service\Cns\InfoUser();
        $infoUser->saveCollection($entity->getId(), $users);
        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    public function finishTask(int $fkInfo, int $fkUser)
    {

        /* @var $entity \Data\Entity\Cns\Info */
        $entity = (new \Data\Entity\Cns\Info())->load($fkInfo);
        $entity->setDttFinished(new \DateTime());
        $entity->persist([]);

        $infoReply = new \Data\Entity\Cns\InfoReply();
        $infoReply->setDttPosted(new \DateTime());
        $infoReply->setFkUser($fkUser);
        $infoReply->setFkInfo($fkInfo);
        $infoReply->setVrcReply('Atividade finalizada.');
        $infoReply->persist([]);

        $infoUser = new \Data\Service\Cns\InfoUser();
        $infoUser->checkRows($entity->getId());
    }

}
