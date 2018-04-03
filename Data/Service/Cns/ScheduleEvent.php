<?php

namespace Data\Service\Cns;

use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service cns_schedule_category
 *
 * @author moysesoliveira
 */
class ScheduleEvent extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Cns\ScheduleEvent $entity
     * @param array $input
     * @return array
     */
    public function save(\Data\Entity\Cns\ScheduleEvent $entity, array $input): array
    {
        $inspector = new \Data\Inspector\Cns\ScheduleEvent();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();

        if($success)
            $entity->persist($inspector->normalize());

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }
}
