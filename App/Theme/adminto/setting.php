<?php

/* @var $this \Spell\UI\Layout\Theme */

// Add header meta
$this->getHead()->addMeta(['http-equiv' => 'Content-Type', 'content' => 'text/html; charset=UTF-8']);

// Add header css
$this->getHead()->addCss([
    'library/adminto/css/bootstrap.min.css',
    'library/adminto/css/core.css',
    'library/adminto/css/components.css',
    'library/adminto/css/icons.css',
    'library/adminto/css/pages.css',
    'library/adminto/css/menu.css',
    'library/datatables/dataTables.bootstrap.css',
    'library/spell/css/Bootstrap.fix.css',
    'library/notifications/notifications.css',
    'library/adminto/css/responsive.css',
    'library/faloading/jquery.faloading.css'
]);

// Add header js
$this->getHead()->addJs([
    'library/adminto/js/modernizr.min.js',
    'library/adminto/js/jquery.min.js',
    'library/adminto/js/bootstrap.min.js',
    'library/bootstrap/bootbox.min.js',
    'library/adminto/js/detect.js',
    'library/slimScroll/jquery.slimscroll.min.js',
    'library/adminto/js/fastclick.js',
    'library/adminto/js/jquery.slimscroll.js',
    'library/adminto/js/jquery.blockUI.js',
    'library/adminto/js/waves.js',
    'library/adminto/js/wow.min.js',
    'library/adminto/js/jquery.nicescroll.js',
    'library/adminto/js/jquery.scrollTo.min.js',
    'library/adminto/js/jquery.core.js',
    'library/adminto/js/jquery.app.js',
    'library/datatables/jquery.dataTables.js',
    'library/datatables/dataTables.bootstrap.min.js',
    'library/spell/js/HTML.js',
    'library/spell/js/DataTable.js',
    'library/spell/js/UIV.js',
    'library/spell/js/Validator.js',
    'application/cns/js/notifications.js',
    'library/faloading/jquery.faloading.js',
    'application/initializer.js'
]);

// Seting-up wireframes aliases who will have contents
$this->addFrame('header', 'header.php');
$this->addFrame('notifications', 'notifications.php');
$this->addFrame('footer', 'footer.php');

