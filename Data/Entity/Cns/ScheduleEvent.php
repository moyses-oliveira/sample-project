<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_schedule_event")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\ScheduleEvent")
 */
class ScheduleEvent extends AbstractEntity {

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
     * @ORM\Column(name="fkCategory", type="integer", length=10)
     * @var integer 
     */
    protected $fkCategory;
	
    /**
     * @ORM\Column(name="chrTitle", type="string", length=128)
     * @var string 
     */
    protected $chrTitle;
	
    /**
     * @ORM\Column(name="vrcDescription", type="string", length=4096)
     * @var string 
     */
    protected $vrcDescription;
	
    /**
     * @ORM\Column(name="dttBegin", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttBegin;
	
    /**
     * @ORM\Column(name="dttFinish", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttFinish;
	
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
	
    public function getFkCategory()
    {
        return $this->fkCategory;
    }
	
    public function setFkCategory($fkCategory)
    {
        $this->fkCategory = $fkCategory;
    }
	
    public function getChrTitle()
    {
        return $this->chrTitle;
    }
	
    public function setChrTitle($chrTitle)
    {
        $this->chrTitle = $chrTitle;
    }
	
    public function getVrcDescription()
    {
        return $this->vrcDescription;
    }
	
    public function setVrcDescription($vrcDescription)
    {
        $this->vrcDescription = $vrcDescription;
    }
	
    public function getDttBegin()
    {
        return $this->dttBegin;
    }
	
    public function setDttBegin($dttBegin)
    {
        $this->dttBegin = $dttBegin;
    }
	
    public function getDttFinish()
    {
        return $this->dttFinish;
    }
	
    public function setDttFinish($dttFinish)
    {
        $this->dttFinish = $dttFinish;
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