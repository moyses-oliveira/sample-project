<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;


$json = Tag::mk('script')->setAttr('type', 'application/json');
$json->setContent(json_encode($attachments, JSON_PRETTY_PRINT));
$json->setAttr('id', 'dataAttachment');

$div = Tag::div('tab-pane panel panel-default fade')->setAttr('id', 'attachment');
$div->appendChild($json);
$fieldset = Tag::mk('fieldset', 'panel panel-default');
$fieldset->appendChild(Tag::mk('legend')->setContent('Anexos'));
$anexo = Tag::div('clear-fix');
$anexo->setAttributes([
    'data-spell_document' => 1,
    'data-upload' => Route::link(Route::getModule(), 'upload-document'),
    'data-download' => Route::link(Route::getModule(), 'download'),
    'data-readonly' => '0',
    'data-load'=>'#dataAttachment'
]);
$fieldset->appendChild($anexo);
$div->appendChild($fieldset);
return $div;
