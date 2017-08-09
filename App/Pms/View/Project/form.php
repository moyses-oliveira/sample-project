<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$attributes = [
    'data-spell_validator' => true,
    'id' => 'article-form',
    'class' => 'panel clearfix col-xs-12'
];
$form = new Form('article', $action, $attributes);

$form->set(new Text('vrcTitle', 512, null, '', ['placeholder' => 'Título', 'data-minlength' => 2]))->required();
echo Tag::mk('style')->setAttr('type', 'text/css')->setContent('.trumbowyg-box,.trumbowyg-editor { min-height: 80px; } ')->render();
$attr = ['placeholder' => 'resumo', 'style' => 'height: 80px;', 'data-wysiwyg'=>'1'];
$note = new Textarea('txtNote', 65535, null, '', $attr);
$form->set($note)->required();
$form->set(new Submit('submit', 'Postar', ''));

$form->fromArray($data ?? []);

echo $form->open();

#if($saved)
#    echo $form->success(Localization::T($saved))->render();

echo $form->warnings()->render();



echo $form->get('vrcTitle')->render();

echo $form->get('txtNote')->render();

echo $form->get('submit')->render();

echo $form->close();
