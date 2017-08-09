<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\Rule\Regex;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Module extends \Spell\Data\Inspector\EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('fkApp', 11))->isRequired();

        $this->set(new Entry('fkCategory', 11))->isRequired();

        $this->set(new Entry('vrcAlias', 64))->isRequired()->addRule(new Regex('ALIAS', '/^[a-z][a-z0-9\-_]+$/'));

        $int = new Regex('INT', '/^[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5]$/');
        $this->set(new Entry('tnyPriority', 3))->isRequired()->addRule($int);
    }

}
