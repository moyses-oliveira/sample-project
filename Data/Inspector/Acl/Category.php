<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\Rule\Regex;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Category extends \Spell\Data\Inspector\EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('vrcLabel', 256))->isRequired();

        $this->set(new Entry('vrcIcon', 64))->isRequired();

        $int = new Regex('INT', '/^[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5]$/');
        $this->set(new Entry('tnyPriority', 3))->isRequired()->addRule($int);
    }

}
