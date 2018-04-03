<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_user_employee")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\UserEmployee")
 */
class UserEmployee extends AbstractEntity {

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
     * @ORM\Column(name="fkAuthority", type="integer", length=10)
     * @var integer 
     */
    protected $fkAuthority;
	
    /**
     * @ORM\Column(name="tnyCommercial", type="integer", length=3)
     * @var integer 
     */
    protected $tnyCommercial;
	
    /**
     * @ORM\Column(name="txtAbout", type="string", length=65535)
     * @var string 
     */
    protected $txtAbout;
	
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
	
    public function getFkAuthority()
    {
        return $this->fkAuthority;
    }
	
    public function setFkAuthority($fkAuthority)
    {
        $this->fkAuthority = $fkAuthority;
    }
	
    public function getTnyCommercial()
    {
        return $this->tnyCommercial;
    }
	
    public function setTnyCommercial($tnyCommercial)
    {
        $this->tnyCommercial = $tnyCommercial;
    }
	
    public function getTxtAbout()
    {
        return $this->txtAbout;
    }
	
    public function setTxtAbout($txtAbout)
    {
        $this->txtAbout = $txtAbout;
    }
	
}