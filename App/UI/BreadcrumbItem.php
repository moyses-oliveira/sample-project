<?php

namespace App\UI;

use Spell\UI\HTML\AbstractTag;
use Spell\UI\HTML\Tag;

/**
 * Description of BreadcrumbItem
 *
 * @author moysesoliveira
 */
class BreadcrumbItem extends AbstractTag {

    public function __construct(string $label, ?string $url = null)
    {
        parent::__construct('li');
        if($url):
            $this->addClass('breadcrumb-item ms-hover');
            $this->appendChild(Tag::a($url)->setContent($label));
        else:
            $this->addClass('breadcrumb-item ms-hover active');
            $this->setContent($label);
        endif;
    }

}
