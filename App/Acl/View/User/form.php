<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
use Spell\Flash\Path;

$attributes = [
    'data-spell_validator' => true,
    'id' => 'app-form',
    'class' => 'panel clearfix col-sm-offset-2 col-sm-8'
];
$form = new Form('app', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();
    $agent = Path::combine([Route::getRoot(), 'Public', 'img', 'agent.png'], '/');
    $vrcImage = $data['vrcImage'] ?? $agent;
    $avatar = Tag::div('file-uploader')->setAttr('style', 'width: 150px;');
        $fUBtSpan = Tag::mk('span', 'btn btn-success fileinput-button col-xs-12');
        $fUBtSpan->appendChild(Tag::mk('i', 'fa fa-folder'));
            $fInput = Tag::mk('input')->setAttr('type', 'file')->setAttr('name', 'avatar')->setAttr('value', $vrcImage);
        $fUBtSpan->appendChild(Tag::mk('span'));
        $fUBtSpan->appendChild($fInput);
    
    $avatar->appendChild($fUBtSpan);
    $avatar->appendChild(Tag::mk('input')->setAttr('type', 'hidden')->setAttr('name', 'vrcImage')->setAttr('value', $vrcImage));
    $pngTr = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
    $bg = "background: url($vrcImage) center center no-repeat;background-size: contain;";
    $avatar->appendChild(Tag::mk('img')->setAttr('src', $pngTr)->setAttr('style', 'width: 150px; height: 150px; ' . $bg));
$form->addChild('avatar', Tag::div('col-xs-12')->setAttr('id', 'avatar')->appendChild($avatar));
$form->set(new Text('vrcName', 256, 'Name', '', ['placeholder' => 'Digite o seu Nome', 'data-minlength' => 6]))->required();
$form->set(new Email('vrcEmail', 128, 'E-mail', '', ['placeholder' => 'seu@email']))->required();

$profilesSelector = new CheckboxGroup('Selecione os Perfis de Acesso', 'profiles', $profiles);
$profilesSelector->setValues($profilesEnabled);
$form->addChild('prof', $profilesSelector);

$form->set(new Submit('submit', 'Salvar', ''));
$form->fromArray($data ?? []);

echo Tag::mk('div')->setAttr('class', 'panel clearfix')->render();

echo $form->render();
