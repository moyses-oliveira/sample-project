<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_task")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\Task")
 */
class Task extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="chrId", type="string", length=128)
     * @var string 
     */
    protected $chrId;
	
    /**
     * @ORM\Column(name="fkUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkUser;
	
    /**
     * @ORM\Column(name="chrFlag", type="string", length=32)
     * @var string 
     */
    protected $chrFlag;
	
    /**
     * @ORM\Column(name="vrcSummary", type="string", length=256)
     * @var string 
     */
    protected $vrcSummary;
	
    /**
     * @ORM\Column(name="vrcDescription", type="string", length=4096)
     * @var string 
     */
    protected $vrcDescription;
	
    /**
     * @ORM\Column(name="vrcUrl", type="string", length=2048)
     * @var string 
     */
    protected $vrcUrl;
	
    /**
     * @ORM\Column(name="dttPosted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttPosted;
	
    /**
     * @ORM\Column(name="dttFinished", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttFinished;
	
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
	
    public function getChrId()
    {
        return $this->chrId;
    }
	
    public function setChrId($chrId)
    {
        $this->chrId = $chrId;
    }
	
    public function getFkUser()
    {
        return $this->fkUser;
    }
	
    public function setFkUser($fkUser)
    {
        $this->fkUser = $fkUser;
    }
	
    public function getChrFlag()
    {
        return $this->chrFlag;
    }
	
    public function setChrFlag($chrFlag)
    {
        $this->chrFlag = $chrFlag;
    }
	
    public function getVrcSummary()
    {
        return $this->vrcSummary;
    }
	
    public function setVrcSummary($vrcSummary)
    {
        $this->vrcSummary = $vrcSummary;
    }
	
    public function getVrcDescription()
    {
        return $this->vrcDescription;
    }
	
    public function setVrcDescription($vrcDescription)
    {
        $this->vrcDescription = $vrcDescription;
    }
	
    public function getVrcUrl()
    {
        return $this->vrcUrl;
    }
	
    public function setVrcUrl($vrcUrl)
    {
        $this->vrcUrl = $vrcUrl;
    }
	
    public function getDttPosted()
    {
        return $this->dttPosted;
    }
	
    public function setDttPosted($dttPosted)
    {
        $this->dttPosted = $dttPosted;
    }
	
    public function getDttFinished()
    {
        return $this->dttFinished;
    }
	
    public function setDttFinished($dttFinished)
    {
        $this->dttFinished = $dttFinished;
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