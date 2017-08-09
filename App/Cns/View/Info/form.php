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

$form->set(new Text('vrcSummary', 128, 'Resumo', '', ['placeholder'=>'...']))->required();
$form->set(new Textarea('vrcDescription', 2048, 'Descrição', '', ['placeholder'=>'']))->required();

$users = new CheckboxGroup('Selecione os Usuários', 'users', $users);
$users->setValues($usersEnabled);
$form->addChild('users', $users);

$form->set(new Submit('submit', 'Salvar', ''));

$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');


echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();

echo $form->render();