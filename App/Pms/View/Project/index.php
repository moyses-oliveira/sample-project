<?php

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\UI\JQuery\DataTable\TableConfig;
use Spell\UI\JQuery\DataTable\TableRender;
use Spell\UI\JQuery\DataTable\ActionConfig;

$childs = [];
echo Tag::mk('div')->setAttr('class', 'panel clearfix')->appendChild($childs)->render();

$status = 1;

$lang = \Spell\Flash\Localization::T('JQUERY::DATATABLE::LANGUAGE');
$dataURL = Route::link(Route::getModule(), 'datatable');
$tbConfig = new TableConfig($dataURL, $lang);
$tbConfig->setSortDefault(0, false);

$tbConfig->createColumn('vrcName', 'Nome');
$actions = [];
$update = Route::link(Route::getModule(), 'follow', '{vrcAlias}');
$actions[] = new ActionConfig($update, 'crosshairs', 'Acompanhar', 'btn-primary');
$tbConfig->createColumn('id', '&nbsp;', $actions, ['width'=>'110px']);

echo (new TableRender($tbConfig, 'app-data-table'))->render();