<?php if(!class_exists('Rain\Tpl')){exit;}?>&lt;?php

namespace <?php echo $namespace; ?>;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="<?php echo $table; ?>")
 * @ORM\Entity(repositoryClass="<?php echo $repositoryNamespace; ?>\<?php echo $classname; ?>")
 */
class <?php echo $classname; ?> extends AbstractEntity {

<?php $counter1=-1;  if( isset($tbConf) && ( is_array($tbConf) || $tbConf instanceof Traversable ) && sizeof($tbConf) ) foreach( $tbConf as $key1 => $value1 ){ $counter1++; ?>
<?php if( !!$value1->pk ){ ?>
    /**
     * @ORM\Id
     * @ORM\Column(name="<?php echo $key1; ?>", type="<?php echo $value1->php_type; ?>", length=<?php echo $value1->length; ?>)
     * @ORM\GeneratedValue
     * @var <?php echo $value1->php_type; ?> 
     */
    protected $<?php echo $key1; ?>;
	
<?php }else{ ?>
    /**
     * @ORM\Column(name="<?php echo $key1; ?>", type="<?php echo $value1->php_type; ?>", length=<?php echo $value1->length; ?>)
     * @var <?php echo $value1->php_type; ?> 
     */
    protected $<?php echo $key1; ?>;
	
<?php } ?>
<?php } ?>
    public function __construct($data=null)
    {
        if($data)
            $this->fromArray($data);
    }
	
<?php $counter1=-1;  if( isset($tbConf) && ( is_array($tbConf) || $tbConf instanceof Traversable ) && sizeof($tbConf) ) foreach( $tbConf as $key1 => $value1 ){ $counter1++; ?>
    public function get<?php echo $value1->ucname; ?>()
    {
        return $this-><?php echo $key1; ?>;
    }
	
    public function set<?php echo $value1->ucname; ?>($<?php echo $key1; ?>)
    {
        $this-><?php echo $key1; ?> = $<?php echo $key1; ?>;
    }
	
<?php } ?>
}