<?php

namespace Data\Entity\Pms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="pms_post")
 * @ORM\Entity(repositoryClass="Data\Repository\Pms\Post")
 */
class Post extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="fkProject", type="integer", length=10)
     * @var integer 
     */
    protected $fkProject;
	
    /**
     * @ORM\Column(name="fkUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkUser;
	
    /**
     * @ORM\Column(name="chrType", type="string", length=32)
     * @var string 
     */
    protected $chrType;
	
    /**
     * @ORM\Column(name="vrcTitle", type="string", length=256)
     * @var string 
     */
    protected $vrcTitle;
	
    /**
     * @ORM\Column(name="txtNote", type="string", length=65535)
     * @var string 
     */
    protected $txtNote;
	
    /**
     * @ORM\Column(name="dttCreated", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttCreated;
	
    /**
     * @ORM\Column(name="dttUpdated", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttUpdated;
	
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
	
    public function getFkProject()
    {
        return $this->fkProject;
    }
	
    public function setFkProject($fkProject)
    {
        $this->fkProject = $fkProject;
    }
	
    public function getFkUser()
    {
        return $this->fkUser;
    }
	
    public function setFkUser($fkUser)
    {
        $this->fkUser = $fkUser;
    }
	
    public function getChrType()
    {
        return $this->chrType;
    }
	
    public function setChrType($chrType)
    {
        $this->chrType = $chrType;
    }
	
    public function getVrcTitle()
    {
        return $this->vrcTitle;
    }
	
    public function setVrcTitle($vrcTitle)
    {
        $this->vrcTitle = $vrcTitle;
    }
	
    public function getTxtNote()
    {
        return $this->txtNote;
    }
	
    public function setTxtNote($txtNote)
    {
        $this->txtNote = $txtNote;
    }
	
    public function getDttCreated()
    {
        return $this->dttCreated;
    }
	
    public function setDttCreated($dttCreated)
    {
        $this->dttCreated = $dttCreated;
    }
	
    public function getDttUpdated()
    {
        return $this->dttUpdated;
    }
	
    public function setDttUpdated($dttUpdated)
    {
        $this->dttUpdated = $dttUpdated;
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