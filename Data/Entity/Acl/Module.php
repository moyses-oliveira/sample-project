<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_module")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\Module")
 */
class Module extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="fkApp", type="integer", length=10)
     * @var integer 
     */
    protected $fkApp;

    /**
     * @ORM\Column(name="fkCategory", type="integer", length=10)
     * @var integer 
     */
    protected $fkCategory;

    /**
     * @ORM\Column(name="vrcAlias", type="string", length=128)
     * @var string 
     */
    protected $vrcAlias;

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

    public function getFkApp()
    {
        return $this->fkApp;
    }

    public function setFkApp($fkApp)
    {
        $this->fkApp = $fkApp;
    }

    public function getFkCategory()
    {
        return $this->fkCategory;
    }

    public function setFkCategory($fkCategory)
    {
        $this->fkCategory = $fkCategory;
    }

    public function getVrcAlias()
    {
        return $this->vrcAlias;
    }

    public function setVrcAlias($vrcAlias)
    {
        $this->vrcAlias = $vrcAlias;
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
