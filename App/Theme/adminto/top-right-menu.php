<?php

use Spell\UI\HTML\Tag;
use Spell\Flash\Localization;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;

global $totalNotifications;
?>
<div class="navbar-custom-menu pull-right">
    <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success"><?php echo $totalNotifications; ?></span>
            </a>
            <ul class="dropdown-menu">
                <li class="header"></li>
                <li>
                    <ul class="menu"></ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php
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
        #$userDD->appendChild($renderMenuItem(['acl', 'profile', 'update'], 'ti-user m-r-5', 'HEADER::USER::MENU::PROFILE'));
        #$userDD->appendChild($renderMenuItem(['acl', 'profile', 'password'], 'ti-more-alt m-r-5', 'HEADER::USER::MENU::PASS'));
        $userDD->appendChild($renderMenuItem(['acl', 'auth', 'logout'], 'ti-power-off m-r-5', 'HEADER::USER::MENU::LOGOUT'));
        $userBox->appendChild($userBoxA);
        $userBox->appendChild($userDD);
        echo $userBox->render();
        ?>
    </ul>
</div>