<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\UI\JQuery\DataTable\TableConfig;
use Spell\UI\JQuery\DataTable\TableRender;
use Spell\UI\JQuery\DataTable\ActionConfig;

if(!$fkGroup):
    $panel = Tag::div('panel panel-default');
    $panelBody = Tag::div('panel-body');
    $gp = Tag::div('row list-group clearfix');
    foreach($groupOptions as $k=>$g):
        $link = Route::link(Route::getModule(), 'index', $k);
        $cel = Tag::div('col-md-6');
        $icon = Tag::mk('i', 'fa fa-cog')->render();
        $cel->appendChild(Tag::mk('a', 'btn btn-primary btn-block btn-lg')->setAttr('href', $link)->setContent($icon . ' &nbsp; ' . $g));
        $gp->appendChild($cel);
    endforeach;
    $panelBody->appendChild($gp);
    $panel->appendChild($panelBody);
    echo $panel->render();
else:
    $childs = [];
    $childs[] = Tag::mk('a')
        ->setAttr('href', Route::link(Route::getModule(), 'create', $fkGroup))
        ->setAttr('class', 'btn btn-primary pull-right')
        ->appendChild('Novo');
    
    echo Tag::mk('div')->setAttr('class', 'panel clearfix')->appendChild($childs)->render();

    $status = 1;

    $lang = \Spell\Flash\Localization::T('JQUERY::DATATABLE::LANGUAGE');
    $dataURL = Route::link(Route::getModule(), 'datatable', $fkGroup);
    $tbConfig = new TableConfig($dataURL, $lang);
    $tbConfig->setSortDefault(0, false);

    $tbConfig->createColumn('vrcTitle', 'Titulo');
    $tbConfig->createColumn('vrcCategory', 'Categoria');
    $actions = [];
    $update = Route::link(Route::getModule(), 'update', $fkGroup, '{id}');
    $actions[] = new ActionConfig($update, 'pencil', 'Visualizar', 'btn-primary');
    $tbConfig->createColumn('id', '&nbsp;', $actions, ['width'=>'110px']);

    echo (new TableRender($tbConfig, 'app-data-table'))->render();
endif;
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('[name=fkGroup]').change(function() {
            window.location.href = $('[name=url]').val() + $(this).val();
        });
    });
</script>