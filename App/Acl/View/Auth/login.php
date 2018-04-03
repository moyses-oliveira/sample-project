<?php
/* @var $this \Spell\UI\Layout\Theme */

use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;

$form = Tag::mk('form', 'tab-pane fade active in clearfix ')
    ->setAttributes(['method' => 'post', 'name' => 'login', 'data-spell_validator' => 'true'])
    ->setAttributes(['enctype' => 'multipart/form-data', 'id' => 'login'])
    ->setAttr('action', Route::link(Route::getModule(), 'logon'));

$warning = Tag::div('callout callout-danger hide global-form-warnings col-xs-12');
$warning->appendChild(Tag::mk('p'));
$user = Tag::div('form-group col-xs-12');
$userAttr = [
    'type' => 'email',
    'name' => 'email',
    'id' => 'field-user-email',
    'required' => 'required',
    'maxlength' => '256',
    'placeholder' => 'E-mail'
];
$userField = Tag::mk('input', 'form-control')->setAttributes($userAttr);
$userSpan = Tag::mk('span', 'glyphicon glyphicon-envelope form-control-feedback glyphicon-ok');
$user->appendChild($userField)->appendChild($userSpan)->appendChild(Tag::div('form-error-message'));

$pass = Tag::div('form-group col-xs-12');
$passAttr = [
    'type' => 'password',
    'name' => 'pass',
    'id' => 'field-user-pass',
    'required' => 'required',
    'maxlength' => '256',
    'placeholder' => 'senha'
];
$passField = Tag::mk('input', 'form-control')->setAttributes($passAttr);
$passSpan = Tag::mk('span', 'glyphicon glyphicon-lock form-control-feedback');
$pass->appendChild($passField)->appendChild($passSpan)->appendChild(Tag::div('form-error-message'));

$submit = Tag::div('form-group col-xs-12 clearfix');
$submit->appendChild(Tag::mk('button', 'btn btn-primary pull-right')->setContent('<i class="fa fa-sign-in"></i> &nbsp;Login'));
$forget = Route::link(Route::getModule(), 'forgot-password');
$submit->appendChild(Tag::a($forget, 'btn btn-default pull-right')->setContent('<i class="fa fa-question"></i> &nbsp;Esqueceu a senha?'));

$autologin = Tag::div('tab-pane fade active in clearfix');
$usersAutologin = $GLOBALS['usersAutologin'] ?? [];

foreach ($usersAutologin as $label => $auth)
    $autologin->appendChild(
        Tag::a('#', 'btn btn-primary btn-block btn-sm autologin')
            ->setAttributes(['data-email' => $auth[0], 'data-pass' => $auth[1]])
            ->setContent($label)
    );


$form->appendChild($warning)->appendChild($user)->appendChild($pass)->appendChild($submit);
echo $form->render();
echo $autologin->render();
?>
<script type="text/javascript">
    function userInfo(email, pass) {
        this.email = email;
        this.pass = pass;
    }
    ;
    
    window.autologin = {
        
    };
    
    function mkAutologin(e) {
        e.preventDefault();
        var auth = {
            email: $(this).data('email'),
            pass: $(this).data('pass')
        };
        $('[name=email]').val(auth.email);
        $('[name=pass]').val(auth.pass);
        $('form[name=login]').submit();
    }
    $(document).ready(function () {
        $('a.autologin').each(function () {
            $(this).click(mkAutologin);
        });
    });
</script>