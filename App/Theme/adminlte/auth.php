<?php 
/* @var $this \Spell\UI\Layout\Theme */ 
use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;

echo HTML5::start();

echo $this->getHead()->render();

##################
    
$logoImg = '/MI/img/madeiramadeira.png';
$body = Tag::mk('body')->setAttr('class', 'hold-transition skin-blue sidebar-mini layout-boxed clearfix');
    $box = Tag::div('login-box');
        $logo = Tag::div('login-logo')->appendChild(Tag::mk('img')->setAttr('src', $logoImg));
        $boxBody = Tag::div('login-box-body');
        $boxBody->appendChild(Tag::div('ajax-messages'));
        $boxBody->appendChild($this->renderView('content'));
        
    $box->appendChild($logo)->appendChild($boxBody);
echo $body->appendChild($box)->render();

echo HTML5::end();