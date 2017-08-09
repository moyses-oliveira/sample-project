<?php 
/* @var $this \Spell\UI\Layout\Theme */ 
use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;
echo HTML5::start();

echo $this->getHead()->render();

$body = Tag::mk('body')->setAttr('class', 'hold-transition skin-blue sidebar-mini layout-boxed clearfix');
    $wrapper = Tag::div('wrapper clearfix');
        $content = Tag::div('content');
            $boxPrimary = Tag::div('alert alert-primary');
                $boxBody = Tag::mk('p', 'text-center')->appendChild($this->renderView('content'));
            $boxPrimary->appendChild($boxBody);
        $content->appendChild($boxPrimary);
    $wrapper->appendChild($content);
$body->appendChild($wrapper);

echo $body->render();

echo HTML5::end();