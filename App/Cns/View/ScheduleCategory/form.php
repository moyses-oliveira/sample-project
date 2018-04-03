<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;

$attributes = [
    'data-spell_validator' => true,
    'id' => 'app-form',
    'class' => 'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('schedule-category', $action, $attributes);

if ($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$form->set(new Text('chrCategory', 128, 'Nome da Categoria', '', ['placeholder' => '...']))->required();
$form->set(new Submit('submit', 'Salvar', ''));

$form->fromArray($data ?? ['tnyPriority' => 0]);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');

echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();

echo $form->render();
