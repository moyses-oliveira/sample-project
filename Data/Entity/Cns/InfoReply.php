<?php

namespace Data\Entity\Cns;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cns_info_reply")
 * @ORM\Entity(repositoryClass="Data\Repository\Cns\InfoReply")
 */
class InfoReply extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="fkInfo", type="integer", length=10)
     * @var integer 
     */
    protected $fkInfo;
	
    /**
     * @ORM\Column(name="fkUser", type="integer", length=10)
     * @var integer 
     */
    protected $fkUser;
	
    /**
     * @ORM\Column(name="vrcReply", type="string", length=4096)
     * @var string 
     */
    protected $vrcReply;
	
    /**
     * @ORM\Column(name="dttPosted", type="datetime", length=20)
     * @var datetime 
     */
    protected $dttPosted;
	
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
	
    public function getFkInfo()
    {
        return $this->fkInfo;
    }
	
    public function setFkInfo($fkInfo)
    {
        $this->fkInfo = $fkInfo;
    }
	
    public function getFkUser()
    {
        return $this->fkUser;
    }
	
    public function setFkUser($fkUser)
    {
        $this->fkUser = $fkUser;
    }
	
    public function getVrcReply()
    {
        return $this->vrcReply;
    }
	
    public function setVrcReply($vrcReply)
    {
        $this->vrcReply = $vrcReply;
    }
	
    public function getDttPosted()
    {
        return $this->dttPosted;
    }
	
    public function setDttPosted($dttPosted)
    {
        $this->dttPosted = $dttPosted;
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