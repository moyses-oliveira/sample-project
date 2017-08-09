<?php

namespace Data\Entity\Pms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="pms_file")
 * @ORM\Entity(repositoryClass="Data\Repository\Pms\File")
 */
class File extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

    /**
     * @ORM\Column(name="fkProject", type="integer", length=10)
     * @var integer 
     */
    protected $fkProject;

    /**
     * @ORM\Column(name="vrcFile", type="string", length=2048)
     * @var string 
     */
    protected $vrcFile;

    /**
     * @ORM\Column(name="dttCreated", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttCreated;

    /**
     * @ORM\Column(name="dttUpdated", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttUpdated;

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

    public function getFkProject()
    {
        return $this->fkProject;
    }

    public function setFkProject($fkProject)
    {
        $this->fkProject = $fkProject;
    }

    public function getVrcFile()
    {
        return $this->vrcFile;
    }

    public function setVrcFile($vrcFile)
    {
        $this->vrcFile = $vrcFile;
    }

    public function getDttCreated()
    {
        return $this->dttCreated;
    }

    public function setDttCreated($dttCreated)
    {
        $this->dttCreated = $dttCreated;
    }

    public function getDttUpdated()
    {
        return $this->dttUpdated;
    }

    public function setDttUpdated($dttUpdated)
    {
        $this->dttUpdated = $dttUpdated;
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
