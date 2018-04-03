<?php
namespace Spell\UI\Bootstrap;

use Spell\MVC\Flash\Route;
use Spell\UI\HTML\Tag;

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule(), 'create'))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Novo Evento');

echo Tag::mk('div')->setAttr('style', 'max-width: 800px;margin: 0 auto;')->addClass('panel clearfix')->appendChild($childs)->render();

$attributes = [
    'data-spell_validator' => true,
    'id' => 'filter-form',
    'class' => 'clearfix',
    'style' => 'max-width: 800px;margin: 0 auto;'
];
$form = new Form('cat', "#", $attributes);


$fkCategory = new Select('fkCategory', $categories, 'Categoria', 'Todas');
$fkCategory->getBox()->addClass('col-xs-12');
$form->set($fkCategory);

echo $form->render();

$attr = [
    'style' => 'max-width: 800px;margin: 0 auto;',
    'data-schedule-event' => 'true',
    'data-src' => Route::link(Route::getModule(), 'data')
];
echo Tag::div('clearfix')->setAttributes($attr)->render();
