<?php
use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
global $acl;

echo '<style type="text/css"> '
. '.dashboard-list-group { list-style-type: none; margin-bottom: 15px; }'
. '.dashboard-list-group>span { font-size: 1.5em; }'
. '</style>';
    

$angleSpan = Tag::mk('span');
$liHeadTpl = Tag::mk('span')->setAttr('href', '#')
    ->appendChild(Tag::mk('i', '%s'))
    ->appendChild(Tag::mk('span')->setContent('%s'))
    ->appendChild($angleSpan)
    ->render();


$ul = Tag::mk('ul');
$count = 0;
foreach($acl as $k):
    if(($count%3) < 1)
        $ul->appendChild(Tag::mk('li', 'col-md-12 dashboard-list-group'));
            
    $li = Tag::mk('li', 'col-md-4 dashboard-list-group');
    $li->appendChild(sprintf($liHeadTpl, $k[0], Localization::T("nav::$k[1]")));
    $liul = Tag::mk('ul', 'submenu');
    foreach($k[2] as $i):
            
        list($app, $module) = $i;
        $appRoute = Route::get($app);
        if(!$appRoute)
            continue;

        $url = $appRoute->getExpression();
        $href = '//' . trim($url, '/') . '/'  . $module;
        $content = Tag::mk('i', 'fa fa-caret-right')->render() . Localization::T("nav::$app::$module");
        $a = Tag::mk('a')->setAttr('href',$href)->setContent($content);
        $liulli = Tag::mk('li')->appendChild($a);
        $liul->appendChild($liulli);
    endforeach;
    $li->appendChild($liul);
$ul->appendChild($li);
$count++;
endforeach;
echo Tag::div('vec')->appendChild($ul)->render();