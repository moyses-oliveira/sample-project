<?php
/* @var $this \Spell\UI\Layout\Theme */

use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;

echo HTML5::start();

echo $this->getHead()->render();
$body = Tag::mk('body');
$body->appendChild(Tag::div('account-pages'));
$body->appendChild(Tag::div('clearfix'));
    
    // Wrapper
    $wrapper = Tag::div('wrapper-page clearfix');
        $logo = Tag::div('text-center');
        $logo->appendChild(Tag::mk('a', 'logo')->setAttr('href', 'index.html')->setContent('<span>Admin<span>to</span></span>'));
        $logo->appendChild(Tag::mk('h5', 'text-muted m-t-0 font-600')->setContent('Responsive Admin Dashboard'));

        $art = $this->getHead()->getTitle();
        $title = strlen($art[1]) > 0 ? "$art[0] <small>$art[1]</small>" : $art[0];
        $cb = Tag::div('m-t-40 card-box');
        $cbtc = Tag::div('text-center');
        $cbtc->appendChild(Tag::mk('h4', 'text-muted m-t-0 font-600')->setContent($title));
        $cb->appendChild($cbtc);
        $container = Tag::div('card-box panel-body clearfix');
        $container->appendChild($this->renderView('content'));
        
    $wrapper->appendChild($logo)->appendChild($cb)->appendChild($container);
    $body->appendChild($wrapper);

echo $body->render();

echo HTML5::end();

?>
        

