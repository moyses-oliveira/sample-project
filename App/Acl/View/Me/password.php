<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
use Spell\Flash\Path;

$attributes = [
    'data-spell_validator' => true,
    'id' => 'app-form',
    'class' => 'panel clearfix col-sm-offset-3 col-sm-6'
];
$form = new Form('app', $action, $attributes);

$form->addChild(uniqid(), Tag::div('panel clearfix')->appendChild(Tag::mk('h1', 'text-center')->setContent('Alteração de Senha')));

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$form->set(new Password('vrcCurrent', 12, 'Senha Atual', '', ['placeholder' => '******', 'data-minlength' => 6]))->required();

$attr = ['placeholder' => '******', 'data-minlength' => 6];
$form->set(new Password('vrcNew', 12, 'Senha Nova', '', $attr))->required();

$attr2 = ['placeholder' => '******', 'data-minlength' => 6, 'data-password_confirm'=>'[name=vrcNew]'];
$form->set(new Password('vrcNew2', 12, 'Repetir Senha', '', $attr2))->required();

$form->set(new Submit('submit', 'Salvar', ''));

echo $form->render();