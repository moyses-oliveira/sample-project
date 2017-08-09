<?php

namespace Data\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cms_article")
 * @ORM\Entity(repositoryClass="Data\Repository\Cms\Article")
 */
class Article extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="fkGroup", type="integer", length=10)
     * @var integer 
     */
    protected $fkGroup;

    /**
     * @ORM\Column(name="fkCategory", type="integer", length=10)
     * @var integer 
     */
    protected $fkCategory;

    /**
     * @ORM\Column(name="intOrder", type="integer", length=10)
     * @var integer 
     */
    protected $intOrder;

    /**
     * @ORM\Column(name="dttPublished", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttPublished;

    /**
     * @ORM\Column(name="vrcTitle", type="string", length=512)
     * @var string 
     */
    protected $vrcTitle;

    /**
     * @ORM\Column(name="vrcAlias", type="string", length=512)
     * @var string 
     */
    protected $vrcAlias;

    /**
     * @ORM\Column(name="vrcSummary", type="string", length=2048)
     * @var string 
     */
    protected $vrcSummary;

    /**
     * @ORM\Column(name="txtContent", type="string", length=65535)
     * @var string 
     */
    protected $txtContent;

    /**
     * @ORM\Column(name="vrcImageSrc", type="string", length=1024)
     * @var string 
     */
    protected $vrcImageSrc;

    /**
     * @ORM\Column(name="vrcImageTitle", type="string", length=128)
     * @var string 
     */
    protected $vrcImageTitle;

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

    public function getFkGroup()
    {
        return $this->fkGroup;
    }

    public function setFkGroup($fkGroup)
    {
        $this->fkGroup = $fkGroup;
    }

    public function getFkCategory()
    {
        return $this->fkCategory;
    }

    public function setFkCategory($fkCategory)
    {
        $this->fkCategory = $fkCategory;
    }

    public function getIntOrder()
    {
        return $this->intOrder;
    }

    public function setIntOrder($intOrder)
    {
        $this->intOrder = $intOrder;
    }

    public function getDttPublished()
    {
        return $this->dttPublished;
    }

    public function setDttPublished($dttPublished)
    {
        $this->dttPublished = $dttPublished;
    }

    public function getVrcTitle()
    {
        return $this->vrcTitle;
    }

    public function setVrcTitle($vrcTitle)
    {
        $this->vrcTitle = $vrcTitle;
    }

    public function getVrcAlias()
    {
        return $this->vrcAlias;
    }

    public function setVrcAlias($vrcAlias)
    {
        $this->vrcAlias = $vrcAlias;
    }

    public function getVrcSummary()
    {
        return $this->vrcSummary;
    }

    public function setVrcSummary($vrcSummary)
    {
        $this->vrcSummary = $vrcSummary;
    }

    public function getTxtContent()
    {
        return $this->txtContent;
    }

    public function setTxtContent($txtContent)
    {
        $this->txtContent = $txtContent;
    }

    public function getVrcImageSrc()
    {
        return $this->vrcImageSrc;
    }

    public function setVrcImageSrc($vrcImageSrc)
    {
        $this->vrcImageSrc = $vrcImageSrc;
    }

    public function getVrcImageTitle()
    {
        return $this->vrcImageTitle;
    }

    public function setVrcImageTitle($vrcImageTitle)
    {
        $this->vrcImageTitle = $vrcImageTitle;
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
