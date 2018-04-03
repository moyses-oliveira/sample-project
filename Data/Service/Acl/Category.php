<?php

namespace Data\Service\Acl;

use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service acl_category
 *
 * @author moysesoliveira
 */
class Category extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Acl\Category $entity
     * @param array $input
     * @return array
     */
    public function save(\Data\Entity\Acl\Category $entity, array $input): array
    {
        $inspector = new \Data\Inspector\Acl\Category();
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
        /* @var $repository \Data\Repository\Acl\Category */
        $repository = $this->getRepository('Data\Entity\Acl\Category');
        return $repository->isRepeated($id, $input['vrcLabel']);
    }

}
