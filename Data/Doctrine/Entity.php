<?php

namespace Data\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="INFORMATION_SCHEMA")
 * @ORM\Entity(repositoryClass="Data\Doctrine\Repository")
 */

class Entity extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
}
