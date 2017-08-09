<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_profile_module")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\ProfileModule")
 */
class ProfileModule extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="fkProfile", type="integer", length=10)
     * @var integer 
     */
    protected $fkProfile;

    /**
     * @ORM\Column(name="fkModule", type="integer", length=10)
     * @var integer 
     */
    protected $fkModule;

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

    public function getFkProfile()
    {
        return $this->fkProfile;
    }

    public function setFkProfile($fkProfile)
    {
        $this->fkProfile = $fkProfile;
    }

    public function getFkModule()
    {
        return $this->fkModule;
    }

    public function setFkModule($fkModule)
    {
        $this->fkModule = $fkModule;
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
