<?php

use Spell\UI\HTML\Tag;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;
use Spell\Flash\DBAL;

/* @var $notifications \Data\Repository\Cns\InfoUser */
$em = DBAL::get('default')->getEm();
$notifications = $em->getRepository(\Data\Entity\Cns\InfoUser::class);
$fkUser = $GLOBALS['user']['id'];
$countTask = $em->getRepository(\Data\Entity\Cns\TaskUser::class)->getTotalNewMessagesByUser($fkUser);
$countInfo = $notifications->getTotalNewMessagesByUser($fkUser);

#require 'restrict.php';

# Nav with tasks
$navTask = Tag::mk('li', 'dropdown messages-menu');
$navTask->appendChild(
    Tag::a(Route::getRoot() . Path::combine(['cns', 'task', 'load-messages'], '/'), 'dropdown-toggle')
        ->setAttributes(['data-toggle' => 'dropdown', 'aria-expanded' => 'true', 'data-type' => 'task'])
        ->setChilds([Tag::mk('i', 'fa fa-flag'), Tag::mk('span', 'label label-success')->setContent($countTask)])
);
$navTask->appendChild(
    Tag::mk('ul', 'dropdown-menu')->setChilds([
        Tag::mk('li', 'header'),
        Tag::mk('li')->appendChild(Tag::mk('ul', 'menu')),
        #Tag::mk('li', 'footer')->appendChild(Tag::a('#')->setContent('Todas as Mensagens'))
    ])
);

# Nav with notifications
$navInfo = Tag::mk('li', 'dropdown messages-menu');
$navInfo->appendChild(
    Tag::a(Route::getRoot() . Path::combine(['cns', 'info', 'load-messages'], '/'), 'dropdown-toggle')
        ->setAttributes(['data-toggle' => 'dropdown', 'aria-expanded' => 'true', 'data-type' => 'info'])
        ->setChilds([Tag::mk('i', 'fa fa-envelope'), Tag::mk('span', 'label label-success')->setContent($countInfo)])
);
$navInfo->appendChild(
    Tag::mk('ul', 'dropdown-menu')->setChilds([
        Tag::mk('li', 'header'),
        Tag::mk('li')->appendChild(Tag::mk('ul', 'menu')),
        #Tag::mk('li', 'footer')->appendChild(Tag::a('#')->setContent('Todas as Mensagens'))
    ])
);


$renderMenuItem = function($link, $icon, $label): \Spell\UI\HTML\RenderInterface {
    $i = Tag::mk('i', $icon);
    $url = Route::getRoot() . Path::combine($link, '/');
    $a = Tag::mk('a')->setAttr('href', $url)->setContent($i->render() . ' &nbsp;' . Localization::T($label));
    return Tag::mk('li')->appendChild($a);
};
$userBox = Tag::mk('li', 'dropdown user-box');
$userBoxA = Tag::mk('a', 'dropdown-toggle waves-effect waves-light profile');
$userBoxA->setAttributes(['data-toggle' => 'dropdown', 'aria-expanded' => 'true']);
$userBoxImg = Tag::mk('img', 'img-circle user-img')->setAttributes(['src' => $GLOBALS['user']['icon'], 'alt' => 'user-img']);
$userBoxSt = Tag::div('user-status away')->appendChild(Tag::mk('i', 'zmdi zmdi-dot-circle'));
$userBoxA->appendChild($userBoxImg)->appendChild($userBoxSt);
$userDD = Tag::mk('ul', 'dropdown-menu');
$userDD->appendChild($renderMenuItem(['acl', 'me', 'update'], 'ti-user m-r-5', 'HEADER::USER::MENU::PROFILE'));
$userDD->appendChild($renderMenuItem(['acl', 'me', 'password'], 'ti-more-alt m-r-5', 'HEADER::USER::MENU::PASS'));
$userDD->appendChild($renderMenuItem(['acl', 'auth', 'logout'], 'ti-power-off m-r-5', 'HEADER::USER::MENU::LOGOUT'));
$userBox->appendChild($userBoxA);
$userBox->appendChild($userDD);

$mobileToggle = Tag::div('menu-item')
    ->appendChild(
    Tag::a('', 'navbar-toggle')
    ->appendChild(Tag::div('lines')->setChilds([Tag::mk('span'), Tag::mk('span'), Tag::mk('span')]))
);

$bodyPull = Tag::div('navbar-custom-menu pull-right');
$bodyPull->appendChild(Tag::mk('ul', 'nav navbar-nav')->setChilds([$navTask, $navInfo, $userBox]));

echo Tag::div('menu-extras')->setChilds([$bodyPull, $mobileToggle])->render();
