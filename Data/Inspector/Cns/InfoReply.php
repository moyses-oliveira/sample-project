<?php

namespace Data\Inspector\Cns;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class InfoReply extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('fkUser', 10))->isRequired();
        
        $this->set(new Entry('fkInfo', 10))->isRequired();
            
        $this->set(new Entry('vrcReply', 4096))->isRequired();
    }

}
