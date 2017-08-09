<?php
use \Spell\PPP;
use \Spell\Path;

// Add header meta
$this->addMeta(['http-equiv'=>'Content-Type', 'content'=>'text/html; charset=UTF-8']);

// Add header css
$this->addCss(['bootstrap/bootstrap.min.css', 'bootstrap/bootstrap-theme.min.css']);

// Add header js
$this->addJs(['jquery/jquery-3.1.1.min.js', 'bootstrap/bootstrap.min.js']);


// Seting-up wireframes aliases who will have contents
$this->setFrame('header', $this->getThemePath() . 'header.php');
$this->setFrame('left');
$this->setFrame('content');
$this->setFrame('right');
$this->setFrame('footer', $this->getThemePath() . 'footer.php');