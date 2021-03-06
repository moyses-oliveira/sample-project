<?php

namespace Data\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cms_article_image")
 * @ORM\Entity(repositoryClass="Data\Repository\Cms\ArticleImage")
 */
class ArticleImage extends AbstractEntity {

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
     * @ORM\Column(name="fkUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkUser;

    /**
     * @ORM\Column(name="intOrder", type="integer", length=10)
     * @var integer 
     */
    protected $intOrder;

    /**
     * @ORM\Column(name="vrcSrc", type="string", length=1024)
     * @var string 
     */
    protected $vrcSrc;

    /**
     * @ORM\Column(name="vrcName", type="string", length=256)
     * @var string 
     */
    protected $vrcName;

    /**
     * @ORM\Column(name="chrExt", type="string", length=16)
     * @var string 
     */
    protected $chrExt;

    /**
     * @ORM\Column(name="vrcAlt", type="string", length=256)
     * @var string 
     */
    protected $vrcAlt;

    /**
     * @ORM\Column(name="vrcTitle", type="string", length=256)
     * @var string 
     */
    protected $vrcTitle;

    /**
     * @ORM\Column(name="vrcSummary", type="string", length=2048)
     * @var string 
     */
    protected $vrcSummary;

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

    public function getFkUser()
    {
        return $this->fkUser;
    }

    public function setFkUser($fkUser)
    {
        $this->fkUser = $fkUser;
    }

    public function getIntOrder()
    {
        return $this->intOrder;
    }

    public function setIntOrder($intOrder)
    {
        $this->intOrder = $intOrder;
    }

    public function getVrcSrc()
    {
        return $this->vrcSrc;
    }

    public function setVrcSrc($vrcSrc)
    {
        $this->vrcSrc = $vrcSrc;
    }

    public function getVrcName()
    {
        return $this->vrcName;
    }

    public function setVrcName($vrcName)
    {
        $this->vrcName = $vrcName;
    }

    public function getChrExt()
    {
        return $this->chrExt;
    }

    public function setChrExt($chrExt)
    {
        $this->chrExt = $chrExt;
    }

    public function getVrcAlt()
    {
        return $this->vrcAlt;
    }

    public function setVrcAlt($vrcAlt)
    {
        $this->vrcAlt = $vrcAlt;
    }

    public function getVrcTitle()
    {
        return $this->vrcTitle;
    }

    public function setVrcTitle($vrcTitle)
    {
        $this->vrcTitle = $vrcTitle;
    }

    public function getVrcSummary()
    {
        return $this->vrcSummary;
    }

    public function setVrcSummary($vrcSummary)
    {
        $this->vrcSummary = $vrcSummary;
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
