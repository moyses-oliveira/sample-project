<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_user")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\User")
 */
class User extends AbstractEntity {

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
     * @ORM\Column(name="vrcEmail", type="string", length=256)
     * @var string 
     */
    protected $vrcEmail;

    /**
     * @ORM\Column(name="vrbPass", type="string", length=32)
     * @var string 
     */
    protected $vrbPass;

    /**
     * @ORM\Column(name="vrcToken", type="string", length=64)
     * @var string 
     */
    protected $vrcToken;

    /**
     * @ORM\Column(name="vrcImage", type="string", length=1024)
     * @var string 
     */
    protected $vrcImage;

    /**
     * @ORM\Column(name="dttAdded", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttAdded;

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

    public function getVrcName()
    {
        return $this->vrcName;
    }

    public function setVrcName($vrcName)
    {
        $this->vrcName = $vrcName;
    }

    public function getVrcEmail()
    {
        return $this->vrcEmail;
    }

    public function setVrcEmail($vrcEmail)
    {
        $this->vrcEmail = $vrcEmail;
    }

    public function getVrbPass()
    {
        return $this->vrbPass;
    }

    public function setVrbPass($vrbPass)
    {
        $this->vrbPass = $vrbPass;
    }

    public function getVrcToken()
    {
        return $this->vrcToken;
    }

    public function setVrcToken($vrcToken)
    {
        $this->vrcToken = $vrcToken;
    }

    public function getVrcImage()
    {
        return $this->vrcImage;
    }

    public function setVrcImage($vrcImage)
    {
        $this->vrcImage = $vrcImage;
    }

    public function getDttAdded()
    {
        return $this->dttAdded;
    }

    public function setDttAdded($dttAdded)
    {
        $this->dttAdded = $dttAdded;
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
