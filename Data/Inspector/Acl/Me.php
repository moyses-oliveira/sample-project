<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Me extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('vrcName', 256))->isRequired();
        
        $this->set(new Entry('vrcImage', 1024));
        
    }

    public function hash(string $vrcEmail, string $vrbPass) {
        return md5(md5($vrcEmail) . $vrbPass);
    }
}
