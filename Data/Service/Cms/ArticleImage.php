<?php

namespace Data\Service\Cms;

use Spell\Data\Doctrine\AbstractService;

/**
 * Description of ArticleImage
 *
 * @author moysesoliveira
 */
class ArticleImage extends AbstractService {

    /**
     *
     * @var \Data\Entity\Cms\ArticleImage
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

    public function setFkArticle(int $fkArticle): ArticleImage
    {
        $this->fkArticle = $fkArticle;
        return $this;
    }

    public function getFkUser()
    {
        return $this->fkUser;
    }

    public function setFkUser(int $fkUser): ArticleImage
    {
        $this->fkUser = $fkUser;
        return $this;
    }

    public function saveCollection(array $collection)
    {
        $this->clearRows();
        $intOrder = 0;
        foreach($collection as $row)
            $this->saveRow($intOrder++, $row);
    }

    private function saveRow($intOrder, $row)
    {
        $data = json_decode($row['data']);
        $params = [
            'fkArticle' => $this->getFkArticle(),
            'fkUser' => $this->getFkUser(),
            'vrcName' => $data->name,
            'vrcSrc' => $data->src,
            'chrExt' => $data->ext,
            'vrcAlt' => $row['alt'],
            'vrcTitle' => $row['title'],
            'vrcSummary' => $row['summary'],
            'intOrder' => $row['order']
        ];
        if($this->isRegistered($data->src))
            return $this->update($params);

        return $this->insert($params);
    }

    private function isRegistered($vrcSrc)
    {
        $fkArticle = $this->getFkArticle();
        $result = $this->getEm()->createQueryBuilder()
            ->from('Data\Entity\Cms\ArticleImage', 't')
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
            ->update('Data\Entity\Cms\ArticleImage', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->where('t.fkArticle=:fkArticle')
            ->setParameter('dttDeleted', new \DateTime())
            ->setParameter('fkArticle', $this->getFkArticle())
            ->getQuery()->execute();
        return true;
    }

    private function update($params)
    {
        $update['fkArticle'] = $this->getFkArticle();
        $update['dttDeleted'] = null;
        $update['vrcSrc'] = $params['vrcSrc'];
        $update['vrcAlt'] = $params['vrcAlt'];
        $update['vrcTitle'] = $params['vrcTitle'];
        $update['vrcSummary'] = $params['vrcSummary'];
        $update['intOrder'] = $params['intOrder'];
        $this->getEm()->createQueryBuilder()
            ->update('Data\Entity\Cms\ArticleImage', 't')
            ->set('t.dttDeleted', ':dttDeleted')
            ->set('t.vrcAlt', ':vrcAlt')
            ->set('t.vrcTitle', ':vrcTitle')
            ->set('t.vrcSummary', ':vrcSummary')
            ->set('t.intOrder', ':intOrder')
            ->where('t.fkArticle=:fkArticle', 't.vrcSrc=:vrcSrc')
            ->setParameters($update)
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
        $entity = new \Data\Entity\Cms\ArticleImage();
        $entity->persist($params);
        return $entity;
    }

}
