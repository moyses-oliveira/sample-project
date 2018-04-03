<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_user_contact")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\UserContact")
 */
class UserContact extends AbstractEntity {

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
     * @ORM\Column(name="fkContactMode", type="integer", length=5)
     * @var integer 
     */
    protected $fkContactMode;
	
    /**
     * @ORM\Column(name="vrcContact", type="string", length=256)
     * @var string 
     */
    protected $vrcContact;
	
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
	
    public function getFkContactMode()
    {
        return $this->fkContactMode;
    }
	
    public function setFkContactMode($fkContactMode)
    {
        $this->fkContactMode = $fkContactMode;
    }
	
    public function getVrcContact()
    {
        return $this->vrcContact;
    }
	
    public function setVrcContact($vrcContact)
    {
        $this->vrcContact = $vrcContact;
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