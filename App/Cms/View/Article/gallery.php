<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;


$json = Tag::mk('script')->setAttr('type', 'application/json');
$json->setContent(json_encode($images, JSON_PRETTY_PRINT));
$json->setAttr('id', 'dataGallery');

$div = Tag::div('tab-pane panel panel-default fade')->setAttr('id', 'gallery');
$div->appendChild($json);
$fieldset = Tag::mk('fieldset', 'panel panel-default');
$fieldset->appendChild(Tag::mk('legend')->setContent('Imagens'));
$anexo = Tag::div('clear-fix');
$anexo->setAttributes([
    'data-spell_gallery' => 1,
    'data-upload' => Route::link(Route::getModule(), 'upload-gallery'),
    'data-download' => Route::link(Route::getModule(), 'download'),
    'data-readonly' => '0',
    'data-load'=>'#dataGallery'
]);
$fieldset->appendChild($anexo);
$div->appendChild($fieldset);
return $div;
