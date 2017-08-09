<?php

namespace Data\Inspector\Cms;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\Rule\Regex;
use Spell\Data\Inspector\EntryCollection;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class Article extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('fkGroup', 11))->isRequired();

        $this->set(new Entry('fkCategory', 11))->isRequired();

        $this->set(new Entry('vrcTitle', 512))->isRequired();

        $this->set(new Entry('vrcAlias', 512))->isRequired()->addRule(new Regex('ALIAS', '/^[a-z][a-z0-9\-_]+$/'));

        $this->set(new Entry('vrcSummary', 2048))->isRequired();

        $this->set(new Entry('txtContent', 65535))->isRequired();

        $this->set(new Entry('vrcImageSrc', 1024));

        $this->set(new Entry('vrcImageTitle', 128));
    }

}
