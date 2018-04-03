<?php

namespace Data\Entity\Pms;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="pms_post_type")
 * @ORM\Entity(repositoryClass="Data\Repository\Pms\PostType")
 */
class PostType extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="chrType", type="string", length=32)
     * @ORM\GeneratedValue
     * @var string 
     */
    protected $chrType;
	
    public function __construct($data=null)
    {
        if($data)
            $this->fromArray($data);
    }
	
    public function getChrType()
    {
        return $this->chrType;
    }
	
    public function setChrType($chrType)
    {
        $this->chrType = $chrType;
    }
	
}