<?php
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;
use Spell\Flash\DBAL;
use Data\Entity\Acl\UserEmployee;

$employee = DBAL::get('default')->getEm()->getRepository(UserEmployee::class)->findOneBy(compact('fkUser'));

if($employee instanceof UserEmployee && Route::getModule() !== 'profile'):
    $h = intval(date('Hi'));
    $w = intval(date('w'));
    if($employee->getTnyCommercial() > 0 && (!($h > 799 && $h < 2401) || in_array($w, [0,6]))):
        $redirect = 'window.location.href = "' . Route::getRoot() . Path::combine(['profile', 'commercial-time']). '"';
        echo Tag::mk('script')->setAttr('type', 'text/javascript')->setContent($redirect)->render();
    elseif(!$employee->getTxtAbout()):
        $redirect = 'window.location.href = "' . Route::getRoot() . Path::combine(['profile', 'update']). '"';
        echo Tag::mk('script')->setAttr('type', 'text/javascript')->setContent($redirect)->render();
    endif;
endif;