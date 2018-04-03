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

$tnyLevel = new Select('tnyLevel', $levelCollection, 'Prioridade', 'Selecione ...');
$form->set($tnyLevel);
$form->set(new Text('vrcSummary', 128, 'Resumo', '', ['placeholder'=>'...']))->required();
$form->set(new Textarea('vrcDescription', 2048, 'Descrição', '', ['placeholder'=>'']))->required();


$userCollection = new CheckboxGroup('Selecione os Usuários', 'users', $users);
foreach($userCollection->getCollection() as &$user):
    $user->getBox()->addClass('col-md-4 col-sm-6 col-xs-12');
    $user->getField()->addClass('user-checkbox');
endforeach;
    
$userCollection->setValues($usersEnabled);

$groups['all'] = 'Todos';
$group = new Select('groups', $groups, 'Grupo', 'Nenhum');
$group->getField()->setAttr('cns-form-group-selector', 'true');
$userCollection->getFieldset()->preppendChild($group);

$form->addChild('users', $userCollection);

$form->set(new Submit('submit', 'Salvar', ''));

$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');


echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();

echo $form->render();