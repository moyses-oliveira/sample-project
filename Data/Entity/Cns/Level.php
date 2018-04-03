<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_level")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\Level")
 */
class Level extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=3)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="tnyValue", type="integer", length=3)
     * @var integer 
     */
    protected $tnyValue;
	
    /**
     * @ORM\Column(name="chrLevel", type="string", length=32)
     * @var string 
     */
    protected $chrLevel;
	
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
	
    public function getTnyValue()
    {
        return $this->tnyValue;
    }
	
    public function setTnyValue($tnyValue)
    {
        $this->tnyValue = $tnyValue;
    }
	
    public function getChrLevel()
    {
        return $this->chrLevel;
    }
	
    public function setChrLevel($chrLevel)
    {
        $this->chrLevel = $chrLevel;
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