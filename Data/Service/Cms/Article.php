<?php

namespace Data\Service\Cms;

use Spell\Data\Inspector\EntryCollectionInterface;
use Spell\Data\Doctrine\AbstractService;
use Spell\Flash\Localization;

/**
 * Service save cms_article
 *
 * @author moysesoliveira
 */
class Article extends AbstractService {

    /**
     * 
     * @param \Data\Entity\Cms\Article $entity
     * @param array $input
     * @return type
     */
    public function save(\Data\Entity\Cms\Article $entity, array $input)
    {
        if (!isset($input['vrcAlias']))
            $input['vrcAlias'] = !$entity->getId() ? 'uid-' . md5(uniqid()) : $entity->getVrcAlias();

        $inspector = new \Data\Inspector\Cms\Article();
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();



        if ($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;

        $entity->setDttPublished(new \DateTime);
        $entity->setIntOrder(0);

        if ($success)
            $entity->persist($inspector->normalize());


        $attachment = new \Data\Service\Cms\ArticleAttachment();
        $attachment->setFkUser($GLOBALS['user']['id'])->setFkArticle($entity->getId());
        $attachment->saveCollection($input['attachment'] ?? []);

        $gallery = new \Data\Service\Cms\ArticleImage();
        $gallery->setFkUser($GLOBALS['user']['id'])->setFkArticle($entity->getId());
        $gallery->saveCollection($input['gallery'] ?? []);

        $data = $entity->toArray();
        return compact('success', 'errors', 'data');
    }

    public function isRepeated($id, array $input)
    {
        /* @var $repository \Data\Repository\Cms\Article */
        $repository = $this->getRepository('Data\Entity\Cms\Article');
        return $repository->isRepeated($id, $input['vrcAlias'], $input['fkGroup']);
    }

}
