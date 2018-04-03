<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$attributes = [
    'data-spell_validator' => true,
    'id' => 'app-form',
    'class' => 'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('app', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$form->set(new Text('vrcName', 256, 'Name', '', ['placeholder' => 'Digite o Nome', 'data-minlength' => 2]))->required();
$form->set(new Text('vrcAlias', 128, 'Alias', '', ['placeholder' => 'app_alias']))->required();

$form->set(new Submit('submit', 'Salvar', ''));
$form->fromArray($data ?? []);


echo Tag::mk('div')->setAttr('class', 'panel clearfix')->render();

echo $form->render();

