<?php
namespace Spell\UI\Bootstrap;
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$attributes = [
    'data-spell_validator'=>true, 
    'id'=>'article-group-form', 
    'class'=>'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('article-group', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$form->set(new Text('vrcName', 256, 'Name', '', ['placeholder'=>'Digite o Nome do Projeto', 'data-minlength'=>2]))->required();
$form->set(new Text('vrcAlias', 128, 'Alias', '', ['placeholder'=>'alias']))->required();
$form->set(new Submit('submit', 'Salvar', ''));

$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');


echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();

echo $form->render();