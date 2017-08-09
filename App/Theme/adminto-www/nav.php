<?php
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
global $acl;

$angleSpan = Tag::mk('span');
$liHeadTpl = Tag::mk('a')->setAttr('href', '#')
    ->appendChild(Tag::mk('i', '%s'))
    ->appendChild(Tag::mk('span')->setContent('%s'))
    ->appendChild($angleSpan)
    ->render();


$ul = Tag::mk('ul', 'navigation-menu');
foreach($acl as $k):
    $li = Tag::mk('li', 'has-submenu');
    $li->appendChild(sprintf($liHeadTpl, $k[0], Localization::T("nav::$k[1]")));
    $liul = Tag::mk('ul', 'submenu');
    foreach($k[2] as $i):
        list($app, $module) = $i;
        $appRoute = Route::get($app);
        if(!$appRoute)
            continue;

        $url = $appRoute->getUrl();
        $href = '//' . trim($url, '/') . '/'  . $module;
        $content = Tag::mk('i', 'fa fa-caret-right')->render() . Localization::T("nav::$app::$module");
        $a = Tag::mk('a')->setAttr('href',$href)->setContent($content);
        $liulli = Tag::mk('li')->appendChild($a);
        $liul->appendChild($liulli);
    endforeach;
    $li->appendChild($liul);
$ul->appendChild($li);
endforeach;

echo Tag::div('active')->setAttr('id', 'navigation')->appendChild($ul)->render();