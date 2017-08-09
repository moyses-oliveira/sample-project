<?php

use Spell\UI\HTML\Tag;
use Spell\UI\JQuery\DataTable\TableConfig;
use Spell\UI\JQuery\DataTable\TableRender;
use Spell\UI\JQuery\DataTable\ActionConfig;
use Spell\MVC\Flash\Route;

echo 'INDEX';

$tags = $childs = [];
$childs[] = Tag::mk('button')->setAttr('class', 'btn btn-block btn-primary')->appendChild('limao');
$tags[] = Tag::mk('div')->setAttr('class', 'panel')->appendChild($childs);


foreach($tags as $tag)
    echo $tag->render();

$status = 1;

$lang = \Spell\Flash\Localization::T('JQUERY::DATATABLE::LANGUAGE');
$dataURL = Route::link(Route::getModule(), 'data?') . http_build_query(['status' => $status]);
$tbConfig = new TableConfig($dataURL, $lang);
$tbConfig->setSortDefault(2, false);

$tbConfig->createColumn('id', 'Nº');
$tbConfig->createColumn('name', 'Nome');
$tbConfig->createColumn('alias', 'Alias');
$tbConfig->createColumn('icon', 'Icon');
$actions = [];
$actions[] = new ActionConfig('/view/{id}', 'plus', 'Visualizar', 'btn-primary');
$tbConfig->createColumn('id', '&nbsp;', $actions);

echo (new TableRender($tbConfig, 'app-data-table-' . strtolower($status)))->render();