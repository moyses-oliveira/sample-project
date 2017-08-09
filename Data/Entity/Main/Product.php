<?php

namespace Data\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Data\Repository\Main\Product")
 */
class Product extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="fkCustomer", type="integer", length=10)
     * @var integer     */
    protected $fkCustomer;
	
    /**
     * @ORM\Column(name="enmType", type="string", length=4)
     * @var string     */
    protected $enmType;
	
    /**
     * @ORM\Column(name="vrcReference", type="string", length=32)
     * @var string     */
    protected $vrcReference;
	
    /**
     * @ORM\Column(name="vrcName", type="string", length=128)
     * @var string     */
    protected $vrcName;
	
    /**
     * @ORM\Column(name="dcmPrice", type="float", length=13)
     * @var float     */
    protected $dcmPrice;
	
    /**
     * @ORM\Column(name="vrcImage", type="string", length=1024)
     * @var string     */
    protected $vrcImage;
	
    /**
     * @ORM\Column(name="vrcSummary", type="string", length=512)
     * @var string     */
    protected $vrcSummary;
	
    /**
     * @ORM\Column(name="txtDescription", type="string", length=65535)
     * @var string     */
    protected $txtDescription;
	
    /**
     * @ORM\Column(name="tnyEnabled", type="integer", length=3)
     * @var integer     */
    protected $tnyEnabled;
	
    /**
     * @ORM\Column(name="dttRegister", type="datetime", length=20)
     * @var datetime     */
    protected $dttRegister;
	
    /**
     * @ORM\Column(name="dttDeleted", type="datetime", length=20)
     * @var datetime     */
    protected $dttDeleted;
	
    public function __construct($data=null)
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
	
    public function getFkCustomer()
    {
        return $this->fkCustomer;
    }
	
    public function setFkCustomer($fkCustomer)
    {
        $this->fkCustomer = $fkCustomer;
    }
	
    public function getEnmType()
    {
        return $this->enmType;
    }
	
    public function setEnmType($enmType)
    {
        $this->enmType = $enmType;
    }
	
    public function getVrcReference()
    {
        return $this->vrcReference;
    }
	
    public function setVrcReference($vrcReference)
    {
        $this->vrcReference = $vrcReference;
    }
	
    public function getVrcName()
    {
        return $this->vrcName;
    }
	
    public function setVrcName($vrcName)
    {
        $this->vrcName = $vrcName;
    }
	
    public function getDcmPrice()
    {
        return $this->dcmPrice;
    }
	
    public function setDcmPrice($dcmPrice)
    {
        $this->dcmPrice = $dcmPrice;
    }
	
    public function getVrcImage()
    {
        return $this->vrcImage;
    }
	
    public function setVrcImage($vrcImage)
    {
        $this->vrcImage = $vrcImage;
    }
	
    public function getVrcSummary()
    {
        return $this->vrcSummary;
    }
	
    public function setVrcSummary($vrcSummary)
    {
        $this->vrcSummary = $vrcSummary;
    }
	
    public function getTxtDescription()
    {
        return $this->txtDescription;
    }
	
    public function setTxtDescription($txtDescription)
    {
        $this->txtDescription = $txtDescription;
    }
	
    public function getTnyEnabled()
    {
        return $this->tnyEnabled;
    }
	
    public function setTnyEnabled($tnyEnabled)
    {
        $this->tnyEnabled = $tnyEnabled;
    }
	
    public function getDttRegister()
    {
        return $this->dttRegister;
    }
	
    public function setDttRegister($dttRegister)
    {
        $this->dttRegister = $dttRegister;
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