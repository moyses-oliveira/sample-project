<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_info")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\Info")
 */
class Info extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="fkUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkUser;
	
    /**
     * @ORM\Column(name="tnyLevel", type="integer", length=3)
     * @var integer 
     */
    protected $tnyLevel;
	
    /**
     * @ORM\Column(name="vrcSummary", type="string", length=256)
     * @var string 
     */
    protected $vrcSummary;
	
    /**
     * @ORM\Column(name="vrcDescription", type="string", length=2048)
     * @var string 
     */
    protected $vrcDescription;
	
    /**
     * @ORM\Column(name="dttPosted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttPosted;
	
    /**
     * @ORM\Column(name="dttDeleted", type="datetime", length=20)
     * @var datetime 
     */
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
	
    public function getFkUser()
    {
        return $this->fkUser;
    }
	
    public function setFkUser($fkUser)
    {
        $this->fkUser = $fkUser;
    }
	
    public function getTnyLevel()
    {
        return $this->tnyLevel;
    }
	
    public function setTnyLevel($tnyLevel)
    {
        $this->tnyLevel = $tnyLevel;
    }
	
    public function getVrcSummary()
    {
        return $this->vrcSummary;
    }
	
    public function setVrcSummary($vrcSummary)
    {
        $this->vrcSummary = $vrcSummary;
    }
	
    public function getVrcDescription()
    {
        return $this->vrcDescription;
    }
	
    public function setVrcDescription($vrcDescription)
    {
        $this->vrcDescription = $vrcDescription;
    }
	
    public function getDttPosted()
    {
        return $this->dttPosted;
    }
	
    public function setDttPosted($dttPosted)
    {
        $this->dttPosted = $dttPosted;
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