<?php

/**
 * Description of Categoria
 *
 * @author Moysés Oliveira
 */

namespace Portal\Form;

use Zend\Form\Form,
    Zend\Form\Element;

class {$classname} extends Form {

    public function __construct($name = null) {
        parent::__construct($classname);

        $this->setAttribute('method', 'post');
		
        $this->setAttribute('id', $pk);
		

{loop="$tbConf"}
{if="!!$value->pk"}
        $this->add([
            'name' => {$key},
            'attributes' => ['type' => 'hidden']
        ]);
{else}
		
	
	
{/if}
{/loop}

	}
}