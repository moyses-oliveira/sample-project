<?php

namespace Data\Inspector\Cns;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class ScheduleCategory extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('chrCategory', 128))->isRequired();
    }

}
