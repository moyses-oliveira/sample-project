<?php
/* @var $theme \Spell\UI\Layout\Theme */

$theme->getHead()->addMeta(['http-equiv'=>'Content-Type', 'content'=>'text/html; charset=UTF-8']);
$theme->getHead()->addCss(['bootstrap/bootstrap.min.css', 'bootstrap/bootstrap-theme.min.css']);
$theme->getHead()->addJs(['jquery/jquery-3.1.1.min.js', 'bootstrap/bootstrap.min.js']);
$theme->addFrame('header', 'header.php');
$theme->addFrame('footer', 'footer.php');