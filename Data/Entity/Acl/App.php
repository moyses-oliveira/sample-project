<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="acl_app")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\App")
 */
class App extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="vrcAlias", type="string", length=64)
     * @var string 
     */
    protected $vrcAlias;

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
