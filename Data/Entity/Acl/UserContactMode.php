<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_user_contact_mode")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\UserContactMode")
 */
class UserContactMode extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=5)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="chrAlias", type="string", length=32)
     * @var string 
     */
    protected $chrAlias;
	
    /**
     * @ORM\Column(name="chrMode", type="string", length=32)
     * @var string 
     */
    protected $chrMode;
	
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
	
    public function getChrAlias()
    {
        return $this->chrAlias;
    }
	
    public function setChrAlias($chrAlias)
    {
        $this->chrAlias = $chrAlias;
    }
	
    public function getChrMode()
    {
        return $this->chrMode;
    }
	
    public function setChrMode($chrMode)
    {
        $this->chrMode = $chrMode;
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