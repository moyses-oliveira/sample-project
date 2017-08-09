<?php
namespace Spell\UI\Bootstrap;
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$attributes = [
    'data-spell_validator'=>true, 
    'id'=>'article-category-form', 
    'class'=>'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('article-category', $action, $attributes);

$form->set(new Select('fkGroup', $groupOptions, 'Grupo', 'Seleciona a app'))->required();
$form->set(new Text('vrcName', 256, 'Name', '', ['placeholder'=>'Digite o Nome', 'data-minlength'=>2]))->required();
$form->set(new Text('vrcAlias', 64, 'Alias', '', ['placeholder'=>'alias', 'data-minlength'=>2]))->required();
$form->set(new Submit('submit', 'Salvar', ''));

$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->setAttr('class', 'btn btn-primary pull-right')
    ->appendChild('Voltar');
echo Tag::mk('div')->setAttr('class', 'panel clearfix')->appendChild($childs)->render();

echo $form->open();

if($saved)
    echo $form->success(Localization::T($saved))->render();

echo $form->warnings()->render();

echo $form->get('fkGroup')->render();

echo $form->get('vrcName')->render();

echo $form->get('vrcAlias')->render();

echo $form->get('submit')->render();

echo $form->close();