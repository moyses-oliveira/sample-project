<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_shedule")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\Shedule")
 */
class Shedule extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="vrcSummary", type="string", length=128)
     * @var string     */
    protected $vrcSummary;
	
    /**
     * @ORM\Column(name="vrcDescription", type="string", length=1024)
     * @var string     */
    protected $vrcDescription;
	
    /**
     * @ORM\Column(name="dttRemember", type="datetime", length=20)
     * @var datetime     */
    protected $dttRemember;
	
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
	
    public function getDttRemember()
    {
        return $this->dttRemember;
    }
	
    public function setDttRemember($dttRemember)
    {
        $this->dttRemember = $dttRemember;
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