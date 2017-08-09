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
     * @param type $data
     * @param type $pk
     * @return type
     * @throws \Entity
     */
    public function save(EntryCollectionInterface $inspector, \Data\Entity\Cms\Article $entity, array $input)
    {
        $inspector->fromArray($input);
        $success = $inspector->validate();
        $errors = $inspector->getErrors();

        if($success && $this->isRepeated($entity->getId(), $input)):
            $success = false;
            $errors['GLOBAL'] = Localization::T(__CLASS__ . '::ERROR_REPEATED');
        endif;

        $entity->setDttPublished(new \DateTime);
        $entity->setIntOrder(0);

        if($success)
            $entity->persist($inspector->normalize($input));

        
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
        return $repository->isRepeated($id, $input['vrcAlias']);
    }

}
