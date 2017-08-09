<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;

$div = Tag::div('tab-pane panel panel-default fade in active')->setAttr('id', 'article');
$fieldset = Tag::mk('fieldset', 'panel panel-default');
$fieldset->appendChild(Tag::mk('legend')->setContent('Descrição'));
$fieldset->appendChild((new Hidden('fkGroup', $fkGroup))->required());
$fieldset->appendChild((new Select('fkCategory', $categoryOptions, 'Categoria', 'Seleciona a app', $data['fkCategory'] ?? null))->required());
$fieldset->appendChild((new Text('vrcTitle', 512, 'Name', $data['vrcTitle'] ?? null, ['placeholder' => 'Digite o Nome do Grupo', 'data-minlength' => 2]))->required());
$fieldset->appendChild((new Text('vrcAlias', 512, 'Alias', $data['vrcAlias'] ?? null, ['placeholder' => 'alias']))->required());
$fieldset->appendChild((new Textarea('vrcSummary', 2048, 'Resumo', $data['vrcSummary'] ?? null, ['placeholder' => 'resumo']))->required());
$attr = ['placeholder' => 'resumo', 'style' => 'min-height: 150px;', 'data-wysiwyg' => '1'];
$fieldset->appendChild((new Textarea('txtContent', 65535, 'Conteúdo', $data['txtContent'] ?? null, $attr))->required());
return $div->appendChild($fieldset);