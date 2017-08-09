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
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                    page and may cause design problems
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user text-red"></i> You changed your username
                                </a>
                            </li>
                        </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                </li>
                <li class="footer"><a href="#">View all</a></li>
            </ul>
        </li>
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Design some buttons
                                        <small class="pull-right">20%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Create a nice theme
                                        <small class="pull-right">40%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">40% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Some task I need to do
                                        <small class="pull-right">60%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Make beautiful transitions
                                        <small class="pull-right">80%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                        </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                </li>
                <li class="footer">
                    <a href="#">View all tasks</a>
                </li>
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
        $userDD->appendChild($renderMenuItem(['acl', 'profile', 'update'], 'ti-user m-r-5', 'HEADER::USER::MENU::PROFILE'));
        $userDD->appendChild($renderMenuItem(['acl', 'profile', 'password'], 'ti-more-alt m-r-5', 'HEADER::USER::MENU::PASS'));
        $userDD->appendChild($renderMenuItem(['acl', 'auth', 'logout'], 'ti-power-off m-r-5', 'HEADER::USER::MENU::LOGOUT'));
        $userBox->appendChild($userBoxA);
        $userBox->appendChild($userDD);
        echo $userBox->render();
        ?>
    </ul>
</div>