<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;

$uid = function() { return md5(uniqid(rand(), true));};
$attributes = [
    'data-spell_validator' => true,
    'id' => 'app-form',
    'class' => 'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('app', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

/* @var $avatar \Spell\UI\HTML\Tag */
$avatar = require realpath(__DIR__ . '/../User') . '/' . 'avatar.php';
$avatar->addClass('col-xs-12')->setAttr('data-endpoint', Route::link(Route::getModule(), 'upload-image'));
$form->addChild('avatar', $avatar);
$form->set(new Text('vrcName', 256, 'Nome', '', ['placeholder' => 'Digite o seu Nome', 'data-minlength' => 6]))->required();

$form->addChild($uid(), Tag::div('clear'));
$form->addChild($uid(), 
    Tag::div('col-md-12')
    ->setAttr('data-acl-user-contact',1)
    ->setAttr('data-collection', json_encode($collection))
    ->setAttr('data-mode-options', json_encode($contactMode))
);

$form->addChild('clearfixpg', Tag::div('clearfix col-xs-12')); 

$form->set(new Submit('submit', 'Salvar', ''));
$form->fromArray($data ?? []);

echo Tag::mk('div')->setAttr('class', 'panel clearfix')->render();

echo $form->render();
