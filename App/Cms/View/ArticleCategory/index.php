<?php

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\UI\JQuery\DataTable\TableConfig;
use Spell\UI\JQuery\DataTable\TableRender;
use Spell\UI\JQuery\DataTable\ActionConfig;

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule(), 'create'))
    ->setAttr('class', 'btn btn-primary pull-right')
    ->appendChild('Novo');
echo Tag::mk('div')->setAttr('class', 'panel clearfix')->appendChild($childs)->render();

$status = 1;

$lang = \Spell\Flash\Localization::T('JQUERY::DATATABLE::LANGUAGE');
$dataURL = Route::link(Route::getModule(), 'datatable');
$tbConfig = new TableConfig($dataURL, $lang);
$tbConfig->setSortDefault(1, false);

$tbConfig->createColumn('groupName', 'Grupo');
$tbConfig->createColumn('categoryName', 'Categoria');
$actions = [];
$update = Route::link(Route::getModule(), 'update', '{id}');
$actions[] = new ActionConfig($update, 'pencil', 'Visualizar', 'btn-primary');
$tbConfig->createColumn('id', '&nbsp;', $actions);

echo (new TableRender($tbConfig, 'app-data-table'))->render();