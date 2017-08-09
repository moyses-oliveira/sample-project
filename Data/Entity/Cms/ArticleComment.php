<?php

namespace Data\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cms_article_comment")
 * @ORM\Entity(repositoryClass="Data\Repository\Cms\ArticleComment")
 */
class ArticleComment extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="fkArticle", type="integer", length=10)
     * @var integer 
     */
    protected $fkArticle;

    /**
     * @ORM\Column(name="fkComment", type="integer", length=10)
     * @var integer 
     */
    protected $fkComment;

    /**
     * @ORM\Column(name="vrcName", type="string", length=256)
     * @var string 
     */
    protected $vrcName;

    /**
     * @ORM\Column(name="vrcComment", type="string", length=2048)
     * @var string 
     */
    protected $vrcComment;

    /**
     * @ORM\Column(name="dttDeleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttDeleted;

    public function __construct($data = null)
    {
        if($data)
            $this->fromArray($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFkArticle()
    {
        return $this->fkArticle;
    }

    public function setFkArticle($fkArticle)
    {
        $this->fkArticle = $fkArticle;
    }

    public function getFkComment()
    {
        return $this->fkComment;
    }

    public function setFkComment($fkComment)
    {
        $this->fkComment = $fkComment;
    }

    public function getVrcName()
    {
        return $this->vrcName;
    }

    public function setVrcName($vrcName)
    {
        $this->vrcName = $vrcName;
    }

    public function getVrcComment()
    {
        return $this->vrcComment;
    }

    public function setVrcComment($vrcComment)
    {
        $this->vrcComment = $vrcComment;
    }

    public function getDttDeleted()
    {
        return $this->dttDeleted;
    }

    public function setDttDeleted($dttDeleted)
    {
        $this->dttDeleted = $dttDeleted;
    }

}
