<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_group")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\Group")
 */
class Group extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="vrcName", type="string", length=256)
     * @var string 
     */
    protected $vrcName;
	
    /**
     * @ORM\Column(name="vrcAlias", type="string", length=128)
     * @var string 
     */
    protected $vrcAlias;
	
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
	
    public function getDttDeleted()
    {
        return $this->dttDeleted;
    }
	
    public function setDttDeleted($dttDeleted)
    {
        $this->dttDeleted = $dttDeleted;
    }
	
}