<?php

namespace App\UI;

use Spell\UI\HTML\AbstractTag;

/**
 * Description of Breadcrumb
 *
 * @author moysesoliveira
 */
class Breadcrumb extends AbstractTag {

    public function __construct(string $class = '')
    {
        parent::__construct('ol');
        $this->addClass('breadcrumb text-right' . $class);
    }
    
    public function add(string $label, ?string $url = null): Breadcrumb
    {
        $this->appendChild(new BreadcrumbItem($label, $url));
        return $this;
    }

}
