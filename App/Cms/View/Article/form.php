<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;

$mkLi = function($id, $label, $cls = '') {
    $a = Tag::mk('a')->setAttr('data-toggle','tab')->setAttr('href',"#$id");
    return Tag::mk('li', $cls)->appendChild($a->setContent($label));
};
$navTabs = Tag::mk('ul', 'nav nav-tabs');
$navTabs->appendChild($mkLi('article', 'Descrição', 'active'));
$navTabs->appendChild($mkLi('gallery', 'Imagens'));
$navTabs->appendChild($mkLi('attachment', 'Arquivos'));

$attributes = [
    'data-spell_validator' => true,
    'id' => 'article-form',
    'class' => 'panel clearfix col-xs-offset-1 col-xs-10'
];
$form = new Form('article', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');

echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();



$tabs = Tag::div('tab-content');
$tabs->appendChild(require 'article.php');
$tabs->appendChild(require 'gallery.php');
$tabs->appendChild(require 'attachment.php');
$form->addChild('nav', $navTabs)->addChild('tabs', $tabs);

$form->set(new Submit('submit', 'Salvar', ''));

echo $form->render();
