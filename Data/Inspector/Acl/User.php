<?php

namespace Data\Inspector\Acl;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;
use Spell\Data\Inspector\Rule\Email;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class User extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('vrcName', 256))->isRequired();
        
        $this->set(new Entry('vrcImage', 1024));

        $this->set(new Entry('vrcEmail', 256))->isRequired()->addRule(new Email());
        
    }

    public function hash(string $vrcEmail, string $vrbPass) {
        return md5(md5($vrcEmail) . $vrbPass);
    }
}
