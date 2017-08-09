<?php
namespace Spell\UI\Bootstrap;
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$attributes = [
    'data-spell_validator'=>true, 
    'id'=>'app-form', 
    'class'=>'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('app', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$form->set(new Select('fkApp', $appOptions, 'App', 'Seleciona a app'))->required();
$form->set(new Select('fkCategory', $categoryOptions, 'Categoria', 'Seleciona a categoria'))->required();
$form->set(new Text('vrcAlias', 64, 'Alias', '', ['placeholder'=>'alias', 'data-minlength'=>2]))->required();
$pattern = '[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5]';
$form->set(new Text('tnyPriority', 3, 'Prioridade', '', ['placeholder'=>'', 'pattern'=>$pattern]))->required();
$form->set(new Submit('submit', 'Salvar', ''));

$form->fromArray($data ?? ['tnyPriority'=>0]);

echo Tag::mk('div')->setAttr('class', 'panel clearfix')->render();

echo $form->render();