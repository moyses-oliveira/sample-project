<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
/*
$div = Tag::div('tab-pane panel panel-default fade in active')->setAttr('id', 'article');
$fieldset = Tag::mk('fieldset', 'panel panel-default');
$fieldset->appendChild(Tag::mk('legend')->setContent('Descrição'));
$fieldset->appendChild((new Hidden('fkGroup', $fkGroup))->required());
$fieldset->appendChild((new Select('fkCategory', $categoryOptions, 'Categoria', 'Seleciona a app', $data['fkCategory'] ?? ''))->required());
$fieldset->appendChild((new Text('vrcTitle', 512, 'Name', $data['vrcTitle'] ?? null, ['placeholder' => 'Digite o Título', 'data-minlength' => 2]))->required());
$fieldset->appendChild((new Text('vrcAlias', 512, 'Alias', $data['vrcAlias'] ?? null, ['placeholder' => 'alias']))->required());
$fieldset->appendChild((new Textarea('vrcSummary', 2048, 'Resumo', $data['vrcSummary'] ?? null, ['placeholder' => 'resumo']))->required());
$attr = ['placeholder' => 'resumo', 'style' => 'min-height: 150px;', 'data-wysiwyg' => '1'];
$fieldset->appendChild((new Textarea('txtContent', 65535, 'Conteúdo', $data['txtContent'] ?? null, $attr))->required());
return $div->appendChild($fieldset);
 * 
 */

$div = Tag::div('tab-pane panel panel-default fade in active')->setAttr('id', 'article');
$fieldset = Tag::mk('fieldset', 'panel panel-default');
$fieldset->appendChild(Tag::mk('legend')->setContent('Descrição'));
$fieldset->appendChild((new Hidden('fkGroup', $fkGroup))->required());
$fieldset->appendChild(Tag::div('col-xs-4')->appendChild(require 'image.php'));

$fkCategory = new Select('fkCategory', $categoryOptions, 'Categoria', 'Seleciona a app', $data['fkCategory'] ?? '');
$fieldset->appendChild(Tag::div('col-xs-8')->appendChild($fkCategory));

$vrcTitle = new Text('vrcTitle', 512, 'Name', $data['vrcTitle'] ?? null, ['placeholder' => 'Digite o Título', 'data-minlength' => 2]);
$vrcTitle->required();
$fieldset->appendChild(Tag::div('col-xs-8')->appendChild($vrcTitle));

$vrcAlias = (new Text('vrcAlias', 512, 'Alias', $data['vrcAlias'] ?? null, ['placeholder' => 'alias']))->required();
$fieldset->appendChild(Tag::div('col-xs-8')->appendChild($vrcAlias));

$vrcSummary = (new Textarea('vrcSummary', 2048, 'Resumo', $data['vrcSummary'] ?? null, ['placeholder' => 'resumo']))->required();
$fieldset->appendChild(Tag::div('col-xs-8')->appendChild($vrcSummary));

$fieldset->appendChild(Tag::div('col-xs-12 clearfix'));
$attr = ['placeholder' => 'resumo', 'style' => 'min-height: 150px;', 'data-wysiwyg' => '1'];
$txtContent = (new Textarea('txtContent', 65535, 'Conteúdo', $data['txtContent'] ?? null, $attr))->required();
$txtContent->getBox()->addClass('col-xs-12')->setAttr('style', 'margin-top: 30px;');
$fieldset->appendChild($txtContent);
return $div->appendChild($fieldset);