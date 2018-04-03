<?php

namespace Data\Entity\Pms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="pms_project")
 * @ORM\Entity(repositoryClass="Data\Repository\Pms\Project")
 */
class Project extends AbstractEntity {

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
     * @ORM\Column(name="fkStatus", type="integer", length=10)
     * @var integer 
     */
    protected $fkStatus;
	
    /**
     * @ORM\Column(name="vrcName", type="string", length=255)
     * @var string 
     */
    protected $vrcName;
	
    /**
     * @ORM\Column(name="vrcAlias", type="string", length=255)
     * @var string 
     */
    protected $vrcAlias;
	
    /**
     * @ORM\Column(name="dttStarted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttStarted;
	
    /**
     * @ORM\Column(name="dttDisabled", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttDisabled;
	
    /**
     * @ORM\Column(name="dttDeleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttDeleted;
	
    /**
     * @ORM\Column(name="dttCompleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttCompleted;
	
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
	
    public function getFkStatus()
    {
        return $this->fkStatus;
    }
	
    public function setFkStatus($fkStatus)
    {
        $this->fkStatus = $fkStatus;
    }
	
    public function getVrcName()
    {
        return $this->vrcName;
    }
	
    public function setVrcName($vrcName)
    {
        $this->vrcName = $vrcName;
    }
	
    public function getVrcAlias()
    {
        return $this->vrcAlias;
    }
	
    public function setVrcAlias($vrcAlias)
    {
        $this->vrcAlias = $vrcAlias;
    }
	
    public function getDttStarted()
    {
        return $this->dttStarted;
    }
	
    public function setDttStarted($dttStarted)
    {
        $this->dttStarted = $dttStarted;
    }
	
    public function getDttDisabled()
    {
        return $this->dttDisabled;
    }
	
    public function setDttDisabled($dttDisabled)
    {
        $this->dttDisabled = $dttDisabled;
    }
	
    public function getDttDeleted()
    {
        return $this->dttDeleted;
    }
	
    public function setDttDeleted($dttDeleted)
    {
        $this->dttDeleted = $dttDeleted;
    }
	
    public function getDttCompleted()
    {
        return $this->dttCompleted;
    }
	
    public function setDttCompleted($dttCompleted)
    {
        $this->dttCompleted = $dttCompleted;
    }
	
}