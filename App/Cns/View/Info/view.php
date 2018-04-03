<?php
namespace Spell\UI\Bootstrap;
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$attributes = [
    'data-spell_validator'=>true, 
    'id'=>'cns-view', 
    'class'=>'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('cns', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$tnyLevel = new Select('tnyLevel', $levelCollection, 'Prioridade', 'Selecione ...');
$form->set($tnyLevel);
$form->set(new Text('vrcSummary', 128, 'Resumo', '', ['placeholder'=>'...']))->required();
$form->set(new Textarea('vrcDescription', 2048, 'Descrição', '', ['placeholder'=>'']))->required();

$form->get('tnyLevel')->getField()->setAttr('disabled', 'true')->setAttr('style', 'background-color: #fff;');
$form->get('vrcSummary')->getField()->setAttr('disabled', 'true')->setAttr('style', 'background-color: #fff;');
$form->get('vrcDescription')->getField()->setAttr('disabled', 'true')->setAttr('style', 'background-color: #fff;');

/*
$user = new CheckboxGroup('Selecione os Usuários', 'users', $users);
foreach($users->getCollection() as &$user)
    $user->getBox()->addClass('col-md-4 col-sm-6 col-xs-12');
    
$users->setValues($usersEnabled);
*/
$table = Tag::mk('table', 'table table-striped m-0');
$theadTr = Tag::mk('tr');
$theadTr->appendChild(Tag::mk('th')->setContent('Usuário'));
$theadTr->appendChild(Tag::mk('th')->setContent('Status'));
$table->appendChild(Tag::mk('thead')->appendChild($theadTr));

$tbody = Tag::mk('tbody');
foreach($users as $row):
    $status = !$row['dttChecked'] ? 'Pendente' : 'Visualizado';
    $tr = Tag::mk('tr');
    $tr->appendChild(Tag::mk('td')->setContent($row['vrcName']));
    $tr->appendChild(Tag::mk('td')->setContent($status));
    $tbody->appendChild($tr);
endforeach;
$table->appendChild($tbody)->render();
$to = Tag::mk('fieldset');
$to->setChilds([Tag::mk('legend')->setContent('Destinatários'), $table]);
$form->addChild('toUsers', $to);


$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');


echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();

echo $form->render();