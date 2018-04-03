<?php

namespace Data\Service\Cns;

use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service cns_schedule_category
 *
 * @author moysesoliveira
 */
class ScheduleCategory extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Cns\ScheduleCategory $entity
     * @param array $input
     * @return array
     */
    public function save(\Data\Entity\Cns\ScheduleCategory $entity, array $input): array
    {
        $inspector = new \Data\Inspector\Cns\ScheduleCategory();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();

        if($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;

        if($success)
            $entity->persist($inspector->normalize());

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    public function isRepeated($id, array $input)
    {
        /* @var $repository \Data\Repository\Cns\ScheduleCategory */
        $repository = $this->getRepository(\Data\Entity\Cns\ScheduleCategory::class);
        return $repository->isRepeated($id, $input['chrCategory']);
    }

}
