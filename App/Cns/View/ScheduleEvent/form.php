<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;

$attributes = [
    'data-spell_validator' => true,
    'id' => 'vehicle-form',
    'class' => 'panel clearfix col-md-offset-2 col-md-8',
    'style' => 'min-height: 400px;'
];
$form = new Form('vehicle', $action, $attributes);

if($saved)
    $form->success(Localization::T($saved));

$form->warnings();

$fkCategory = new Select('fkCategory', $categories, 'Categoria', 'Selecione ...');
$fkCategory->required()->getBox()->addClass('col-md-3');
$form->set($fkCategory);

$dteEvent = new Text('dteEvent', 10, 'Data do Evento', '');
$dteEvent->getBox()->addClass('col-md-3');
$dteEvent->getField()
    ->setAttr('data-inputmask', '"mask": "99/99/9999"')
    ->setAttr('data-mask')
    ->setAttr('data-date', '1')
    ->setAttr('datepicker', '1');
$form->set($dteEvent);

$timeBegin = new Text('timeBegin', 10, 'Inicio', '');
$timeBegin->getBox()->addClass('col-md-3');
$timeBegin->getField()
    ->setAttr('data-inputmask', '"mask": "99:99"')
    ->setAttr('data-mask')
    ->setAttr('data-time', '1')
    ->setAttr('timepicker', '1');
$form->set($timeBegin);

$timeFinish = new Text('timeFinish', 10, 'Fim', '');
$timeFinish->getBox()->addClass('col-md-3');
$timeFinish->getField()
    ->setAttr('data-inputmask', '"mask": "99:99"')
    ->setAttr('data-mask')
    ->setAttr('data-time', '1')
    ->setAttr('timepicker', '1');
$form->set($timeFinish);

$form->set(new Text('chrTitle', 128, 'Título', '', ['placeholder'=>'Ex: Festa de fim de ano']))->required();
$form->get('chrTitle')->getBox()->addClass('col-md-12');

$vrcDescription = new Textarea('vrcDescription', 4096, 'Descrição', '');
$vrcDescription->getBox()->addClass('col-md-12');
$vrcDescription->getField()->setAttributes(['style' => 'min-height: 95px']);
$form->set($vrcDescription);

$submit = new Submit('submit', Tag::mk('i', 'fa fa-floppy-o')->render() . ' &nbsp; Salvar', '');
$form->set($submit);



if(isset($data['dttBegin']) && $data['dttBegin'] instanceof \DateTime):
    $data['dteEvent'] = $data['dttBegin']->format('d/m/Y');
    $data['timeBegin'] = $data['dttBegin']->format('H:i');
    
endif;

if(isset($data['dttFinish']) && $data['dttFinish'] instanceof \DateTime)
    $data['timeFinish'] = $data['dttFinish']->format('H:i');

$form->fromArray($data ?? []);

$childs = [];
$childs[] = Tag::mk('a')
    ->setAttr('href', Route::link(Route::getModule()))
    ->addClass('btn btn-primary pull-right')
    ->appendChild('Voltar');

echo Tag::mk('div')->addClass('panel clearfix')->appendChild($childs)->render();

echo $form->render();
?>
<script type="text/javascript">
    $(document).ready(function(){
       $.spell.ValidatorMessages.DATE_DIFF = 'Horario de início deve ser anterior ao horario de termino.'; 
    });
</script>