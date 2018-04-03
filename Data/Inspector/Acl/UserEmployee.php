<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;

/**
 * Description of UserEmployee
 *
 * @author moyses-oliveira
 */
class UserEmployee extends EntryCollection {

    public function __construct()
    {
        parent::__construct();
        
        $this->set(new Entry('fkUser', 10))->required();
        
        $this->set(new Entry('tnyCommercial', 1));
        
        $this->set(new Entry('fkAuthority', 10));
    }
}
