<?php

namespace Data\Inspector\Cns;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Task extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('fkUser', 10))->isRequired();
        
        $this->set(new Entry('chrId', 128))->isRequired();
        
        $this->set(new Entry('chrFlag', 32))->isRequired();
        
        $this->set(new Entry('vrcSummary', 128))->isRequired();

        $this->set(new Entry('vrcDescription', 4096))->isRequired();

        $this->set(new Entry('vrcUrl', 2048));
        
        
    }

}
