<?php

namespace {$namespace};

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="{$table}")
 * @ORM\Entity(repositoryClass="{$repositoryNamespace}\{$classname}")
 */
class {$classname} extends AbstractEntity {

{loop="$tbConf"}
{if="!!$value->pk"}
    /**
     * @ORM\Id
     * @ORM\Column(name="{$key}", type="{$value->php_type}", length={$value->length})
     * @ORM\GeneratedValue
     * @var {$value->php_type} 
     */
    protected ${$key};
	
{else}
    /**
     * @ORM\Column(name="{$key}", type="{$value->php_type}", length={$value->length})
     * @var {$value->php_type} 
     */
    protected ${$key};
	
{/if}
{/loop}
    public function __construct($data=null)
    {
        if($data)
            $this->fromArray($data);
    }
	
{loop="$tbConf"}
    public function get{$value->ucname}()
    {
        return $this->{$key};
    }
	
    public function set{$value->ucname}(${$key})
    {
        $this->{$key} = ${$key};
    }
	
{/loop}
}