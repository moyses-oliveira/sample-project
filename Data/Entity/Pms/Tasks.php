<?php

namespace Data\Entity\Pms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="pms_tasks")
 * @ORM\Entity(repositoryClass="Data\Repository\Pms\Tasks")
 */
class Tasks extends AbstractEntity {

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
     * @ORM\Column(name="txtDescription", type="string", length=65535)
     * @var string 
     */
    protected $txtDescription;

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
     * @ORM\Column(name="dttEStart", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttEStart;

    /**
     * @ORM\Column(name="dttEEnd", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttEEnd;

    /**
     * @ORM\Column(name="dttStart", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttStart;

    /**
     * @ORM\Column(name="dttEnd", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttEnd;

    /**
     * @ORM\Column(name="dttDeleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttDeleted;

    /**
     * @ORM\Column(name="dttCompleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttCompleted;

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

    public function getTxtDescription()
    {
        return $this->txtDescription;
    }

    public function setTxtDescription($txtDescription)
    {
        $this->txtDescription = $txtDescription;
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

    public function getDttEStart()
    {
        return $this->dttEStart;
    }

    public function setDttEStart($dttEStart)
    {
        $this->dttEStart = $dttEStart;
    }

    public function getDttEEnd()
    {
        return $this->dttEEnd;
    }

    public function setDttEEnd($dttEEnd)
    {
        $this->dttEEnd = $dttEEnd;
    }

    public function getDttStart()
    {
        return $this->dttStart;
    }

    public function setDttStart($dttStart)
    {
        $this->dttStart = $dttStart;
    }

    public function getDttEnd()
    {
        return $this->dttEnd;
    }

    public function setDttEnd($dttEnd)
    {
        $this->dttEnd = $dttEnd;
    }

    public function getDttDeleted()
    {
        return $this->dttDeleted;
    }

    public function setDttDeleted($dttDeleted)
    {
        $this->dttDeleted = $dttDeleted;
    }

    public function getDttCompleted()
    {
        return $this->dttCompleted;
    }

    public function setDttCompleted($dttCompleted)
    {
        $this->dttCompleted = $dttCompleted;
    }

}
