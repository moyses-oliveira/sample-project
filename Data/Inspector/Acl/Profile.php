<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;
use Spell\Data\Inspector\Rule\Regex;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Profile extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('vrcName', 256))->isRequired();

        $this->set(new Entry('vrcAlias', 128))->isRequired()->addRule(new Regex('ALIAS', '/^[a-z][a-z0-9\-_]+$/'));
    }

}
