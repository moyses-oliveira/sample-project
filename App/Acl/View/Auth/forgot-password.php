<?php
/* @var $this \Spell\UI\Layout\Theme */

use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;

$form = Tag::mk('form', 'tab-pane fade active in clearfix ')
    ->setAttributes(['method' => 'post', 'name' => 'login', 'data-spell_validator' => 'true'])
    ->setAttributes(['enctype' => 'multipart/form-data', 'id' => 'login'])
    ->setAttr('action', Route::link(Route::getModule(), 'recover-password'));

$warning = Tag::div('callout callout-danger hide global-form-warnings col-xs-12');
$warning->appendChild(Tag::mk('p'));
$user = Tag::div('form-group col-xs-12');
$userAttr = [
    'type' => 'email',
    'name' => 'vrcEmail',
    'id' => 'field-user-email',
    'required' => 'required',
    'maxlength' => '256',
    'placeholder' => 'E-mail'
];
$userField = Tag::mk('input', 'form-control')->setAttributes($userAttr);
$userSpan = Tag::mk('span', 'glyphicon glyphicon-envelope form-control-feedback glyphicon-ok');
$user->appendChild($userField)->appendChild($userSpan)->appendChild(Tag::div('form-error-message'));

$submit = Tag::div('form-group col-xs-12 clearfix');
$submit->appendChild(Tag::mk('button', 'btn btn-primary pull-right')->setContent('<i class="fa fa-sign-in"></i> &nbsp;Recuperar Senha'));
$forget = Route::link(Route::getModule(), 'login');
$submit->appendChild(Tag::a($forget, 'btn btn-default pull-right')->setContent('<i class="fa fa-question"></i> &nbsp;Login'));

$form->appendChild($warning)->appendChild($user)->appendChild($submit);
echo $form->render();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $.spell.ValidatorMessages["Auth\\Login\\Error::INVALID"] = 'Este email não está cadastrado no sistema.';
    });
</script>