<?php

namespace Data\Inspector\Cns;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Info extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('vrcSummary', 128))->isRequired();

        $this->set(new Entry('vrcDescription', 2048))->isRequired();
    }

}
