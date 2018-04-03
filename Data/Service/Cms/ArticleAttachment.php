<?php

namespace Data\Service\Cms;

use Spell\Data\Doctrine\AbstractService;

/**
 * Description of ArticleAttachment
 *
 * @author moysesoliveira
 */
class ArticleAttachment extends AbstractService {

    /**
     *
     * @var \Data\Entity\Cms\ArticleAttachment
     */
    protected $entity = null;

    /**
     *
     * @var int
     */
    private $fkArticle = null;

    /**
     *
     * @var int
     */
    private $fkUser = null;

    public function getFkArticle()
    {
        return $this->fkArticle;
    }

    public function setFkArticle(int $fkArticle): ArticleAttachment
    {
        $this->fkArticle = $fkArticle;
        return $this;
    }

    public function getFkUser()
    {
        return $this->fkUser;
    }

    public function setFkUser(int $fkUser): ArticleAttachment
    {
        $this->fkUser = $fkUser;
        return $this;
    }

    public function saveCollection(array $collection)
    {
        $this->clearRows();
        foreach($collection as $intOrder => $json)
            $this->saveRow($intOrder, $json);
    }

    private function saveRow($intOrder, $json)
    {
        $data = json_decode($json);
        $params = [
            'fkArticle' => $this->getFkArticle(),
            'fkUser' => $this->getFkUser(),
            'vrcSrc' => $data->src,
            'chrExt' => $data->ext,
            'vrcName' => $data->name,
            'intOrder' => $intOrder
        ];
        if($this->isRegistered($data->src))
            return $this->update($intOrder, $data->src);

        return $this->insert($params);
    }

    private function isRegistered($vrcSrc)
    {
        $fkArticle = $this->getFkArticle();
        $result = $this->getEm()->createQueryBuilder()
            ->from('Data\Entity\Cms\ArticleAttachment', 't')
            ->select('COUNT(t) as rows')
            ->where('t.fkArticle=:fkArticle', 't.vrcSrc=:vrcSrc')
            ->setParameters(compact('fkArticle', 'vrcSrc'))
            ->getQuery()
            ->getOneOrNullResult();

        return $result ? current($result) > 0 : null;
    }

    public function clearRows()
    {
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Cms\ArticleAttachment', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkArticle=:fkArticle')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkArticle', $this->getFkArticle())
            ->getQuery()->execute();
        return true;
    }

    private function update(int $intOrder, string $vrcSrc)
    {
        $fkArticle = $this->getFkArticle();
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Cms\ArticleAttachment', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->set('t.intOrder', ':intOrder')
            ->where('t.fkArticle=:fkArticle', 't.vrcSrc=:vrcSrc')
            ->setParameters(compact('fkArticle', 'vrcSrc', 'intOrder'))
            ->setParameter('dttDeleted', null)
            ->getQuery()->execute();
        return true;
    }

    /**
     * 
     * @param type $data
     * @param type $pk
     * @return type
     * @throws \Entity
     */
    private function insert(array $params)
    {
        $entity = new \Data\Entity\Cms\ArticleAttachment();
        $params['dttAdded'] = new \DateTime();
        $entity->persist($params);
        return $entity;
    }

}
