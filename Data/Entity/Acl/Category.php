<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_category")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\Category")
 */
class Category extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="vrcLabel", type="string", length=256)
     * @var string 
     */
    protected $vrcLabel;

    /**
     * @ORM\Column(name="vrcIcon", type="string", length=32)
     * @var string 
     */
    protected $vrcIcon;

    /**
     * @ORM\Column(name="tnyPriority", type="integer", length=3)
     * @var integer 
     */
    protected $tnyPriority;

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

    public function getVrcLabel()
    {
        return $this->vrcLabel;
    }

    public function setVrcLabel($vrcLabel)
    {
        $this->vrcLabel = $vrcLabel;
    }

    public function getVrcIcon()
    {
        return $this->vrcIcon;
    }

    public function setVrcIcon($vrcIcon)
    {
        $this->vrcIcon = $vrcIcon;
    }

    public function getTnyPriority()
    {
        return $this->tnyPriority;
    }

    public function setTnyPriority($tnyPriority)
    {
        $this->tnyPriority = $tnyPriority;
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
