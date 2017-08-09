<?php

/* @var $this \Spell\UI\Layout\Theme */

// Add header meta
$this->getHead()->addMeta(['http-equiv' => 'Content-Type', 'content' => 'text/html; charset=UTF-8']);

// Add header css
$this->getHead()->addCss([
    'library/adminlte/css/font-awesome.css',
    'library/bootstrap/bootstrap.min.css',
    'library/datatables/dataTables.bootstrap.css',
    'library/adminlte/css/skins/_all-skins.min.css',
    'library/adminlte/css/AdminLTE.min.css',
    'library/spell/css/Bootstrap.fix.css',
    'panel/css/ThemeFix.css'
]);

// Add header js
$this->getHead()->addJs([
    'library/jquery/jquery-3.1.1.min.js',
    'library/bootstrap/bootstrap.min.js',
    'library/adminlte/js/bootstrap-filestyle.min.js',
    'library/adminlte/js/bootbox.min.js',
    'library/adminlte/js/validator.min.js',
    'library/adminlte/js/app.js',
    'library/datatables/jquery.dataTables.js',
    'library/datatables/dataTables.bootstrap.min.js',
    'library/spell/js/HTML.js',
    'library/spell/js/DataTable.js',
    'library/spell/js/UIV.js',
    'library/spell/js/Validator.js'
]);

// Seting-up wireframes aliases who will have contents
$this->addFrame('header', 'header.php');
$this->addFrame('sidebar', 'sidebar.php');

