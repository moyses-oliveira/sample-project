<?php

namespace App\Cms\Controller;

use Spell\Flash\Localization;

class Article extends AbstractArticle {

    public function index($fkGroup = null)
    {
        return $this->_index($fkGroup);
    }

    public function datatable($fkGroup)
    {
        return $this->_datatable($fkGroup);
    }

    public function create($fkGroup)
    {
        return $this->_create($fkGroup);
    }

    public function update($fkGroup, $pk)
    {
        return $this->_update($fkGroup, $pk);
    }


    public function save(?string $pk = null)
    {
        return $this->_save($pk);
    }

}
