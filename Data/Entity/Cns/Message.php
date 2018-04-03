<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_message")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\Message")
 */
class Message extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="tnyLevel", type="integer", length=3)
     * @var integer 
     */
    protected $tnyLevel;
	
    /**
     * @ORM\Column(name="fkFromUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkFromUser;
	
    /**
     * @ORM\Column(name="fkToUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkToUser;
	
    /**
     * @ORM\Column(name="vrcMessage", type="string", length=2048)
     * @var string 
     */
    protected $vrcMessage;
	
    /**
     * @ORM\Column(name="dttPosted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttPosted;
	
    /**
     * @ORM\Column(name="dttCompleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttCompleted;
	
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
	
    public function getTnyLevel()
    {
        return $this->tnyLevel;
    }
	
    public function setTnyLevel($tnyLevel)
    {
        $this->tnyLevel = $tnyLevel;
    }
	
    public function getFkFromUser()
    {
        return $this->fkFromUser;
    }
	
    public function setFkFromUser($fkFromUser)
    {
        $this->fkFromUser = $fkFromUser;
    }
	
    public function getFkToUser()
    {
        return $this->fkToUser;
    }
	
    public function setFkToUser($fkToUser)
    {
        $this->fkToUser = $fkToUser;
    }
	
    public function getVrcMessage()
    {
        return $this->vrcMessage;
    }
	
    public function setVrcMessage($vrcMessage)
    {
        $this->vrcMessage = $vrcMessage;
    }
	
    public function getDttPosted()
    {
        return $this->dttPosted;
    }
	
    public function setDttPosted($dttPosted)
    {
        $this->dttPosted = $dttPosted;
    }
	
    public function getDttCompleted()
    {
        return $this->dttCompleted;
    }
	
    public function setDttCompleted($dttCompleted)
    {
        $this->dttCompleted = $dttCompleted;
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