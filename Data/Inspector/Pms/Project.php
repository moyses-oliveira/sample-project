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
class Project extends EntryCollection {

    public function __construct()
    {
        //$this->set(new Entry('fkGroup', 11))->isRequired();

        $this->set(new Entry('vrcName', 256))->isRequired();

        $this->set(new Entry('vrcAlias', 64))->isRequired()->addRule(new Regex('ALIAS', '/^[a-z][a-z0-9\-_]+$/'));
    }

}
