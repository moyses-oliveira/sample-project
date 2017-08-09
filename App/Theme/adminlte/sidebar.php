<?php
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
global $acl;

$angleSpan = Tag::mk('span', 'pull-right-container')
        ->appendChild(Tag::mk('i', 'fa fa-angle-left pull-right'));
$liHeadTpl = Tag::mk('a')->setAttr('href', '#')
    ->appendChild(Tag::mk('i', '%s'))
    ->appendChild(Tag::mk('span')->setContent('%s'))
    ->appendChild($angleSpan)
    ->render();


$sidebar = Tag::mk('section', 'sidebar');
$ul = Tag::mk('ul', 'sidebar-menu');
foreach($acl as $k):
    $li = Tag::mk('li', 'treeview active');
    $li->appendChild(sprintf($liHeadTpl, $k[0], $k[1]));
    $liul = Tag::mk('ul', 'treeview-menu');
    foreach($k[2] as $i):
        list($app, $module) = $i;
        $appRoute = Route::get($app);
        if(!$appRoute)
            continue;

        $url = $appRoute->getUrl();
        $href = '//' . trim($url, '/') . '/'  . $module;
        $content = Tag::mk('i', 'fa fa fa-circle-o')->render() . Localization::T($app . '::' . $module);
        $a = Tag::mk('a')->setAttr('href',$href)->setContent($content);
        $liulli = Tag::mk('li')->appendChild($a);
        $liul->appendChild($liulli);
    endforeach;
    $li->appendChild($liul);
$ul->appendChild($li);
endforeach;
$sidebar->appendChild($ul);

echo Tag::mk('aside', 'main-sidebar')->appendChild($sidebar)->render();