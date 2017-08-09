<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\Rule\Regex;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class App extends \Spell\Data\Inspector\EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('vrcAlias', 64))->isRequired()->addRule(new Regex('ALIAS', '/^[a-z][a-z0-9\-_]+$/')); 
    }

}
