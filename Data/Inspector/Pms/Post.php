<?php

namespace Data\Inspector\Pms;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\Rule\Regex;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Post extends EntryCollection {

    public function __construct()
    {

        $this->set(new Entry('vrcTitle', 256))->isRequired();

        $this->set(new Entry('txtNote', 65535))->isRequired();
    }

}
