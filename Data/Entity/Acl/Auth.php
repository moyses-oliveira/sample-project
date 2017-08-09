<?php

namespace Data\Entity\Acl;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="___")
 * @ORM\Entity(repositoryClass="Data\Repository\Acl\Auth")
 */
class Auth extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;

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

}
