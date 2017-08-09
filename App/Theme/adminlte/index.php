<?php 
/* @var $this \Spell\UI\Layout\Theme */ 
use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;
echo HTML5::start();

echo $this->getHead()->render();

$body = Tag::mk('body')->setAttr('class', 'hold-transition skin-blue sidebar-mini layout-boxed clearfix');

    // Wrapper
    $wrapper = Tag::div('wrapper clearfix');
    
        // Header
        $header = $this->renderFrame('header');
    
        // Sidebar
        $aside = $this->renderFrame('sidebar');
        
        // Content Wrapper
        $cw = Tag::div('content-wrapper clearfix');
            $contentHeader = Tag::mk('section', 'content-header');
            $contentHeader->appendChild(Tag::mk('h1')->setContent($this->getHead()->getTitle()[0]));
            $content = Tag::mk('section', 'content');
                $contentBox = Tag::div('box box-primary clearfix');
                    $breadcrumb = Tag::div('breadcrumb');
                    $main = Tag::div('col-xs-12 clearfix');
                    $main->appendChild($this->renderView('content'));
                $contentBox->appendChild($breadcrumb)->appendChild($main);
            $content->appendChild($contentBox);
        $cw->appendChild($contentHeader)->appendChild($content);
    $wrapper->appendChild($header)->appendChild($aside)->appendChild($cw);
$body->appendChild($wrapper);

echo $body->render();

echo HTML5::end();
