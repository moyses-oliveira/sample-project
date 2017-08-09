<?php
/* @var $this \Spell\UI\Layout\Theme */

use Spell\UI\HTML\HTML5;
use Spell\UI\HTML\Tag;

global $breadcrumb;
echo HTML5::start();

echo $this->getHead()->render();
$body = Tag::mk('body');
    
    // Header
    $header = $this->renderFrame('header');
    
    // Wrapper
    $wrapper = Tag::div('wrapper clearfix');
        
        $container = Tag::div('container');
            $rowHead = Tag::div('row');
                $divHead = Tag::div('col-sm-12');
                    $art = $this->getHead()->getTitle();
                    $title = strlen($art[1]) > 0 ? "$art[0] <small>$art[1]</small>" : $art[0];
                    $tagTitle = Tag::mk('h4', 'page-title col-xs-6')->setContent($title);

                $divBreadcrumb = Tag::div('col-xs-6 ')->appendChild($breadcrumb);
                    
                $divHead->appendChild($tagTitle)->appendChild($divBreadcrumb);
            $rowHead->appendChild($divHead);
        
            $row = Tag::div('row');
                $main = Tag::div('col-sm-12 card-box');
                $main->appendChild($this->renderView('content'));
            
            $row->appendChild($main);
            // Footer
            $footer = $this->renderFrame('footer');
        
        $container->appendChild($rowHead)->appendChild($row)->appendChild($footer);
        
        // Notifications
        $notifications = $this->renderFrame('notifications');
    $wrapper->appendChild($container)->appendChild($notifications);
$body->appendChild($header)->appendChild($wrapper);

echo $body->render();

echo HTML5::end();

