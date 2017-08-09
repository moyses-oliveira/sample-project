<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_user_profile")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\UserProfile")
 */
class UserProfile extends AbstractEntity {

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
     * @ORM\Column(name="fkProfile", type="integer", length=10)
     * @var integer 
     */
    protected $fkProfile;

    /**
     * @ORM\Column(name="dttDeleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttDeleted;

    public function __construct($data = null)
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

    public function getFkProfile()
    {
        return $this->fkProfile;
    }

    public function setFkProfile($fkProfile)
    {
        $this->fkProfile = $fkProfile;
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
