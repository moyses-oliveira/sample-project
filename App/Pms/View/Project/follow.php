<?php

namespace Spell\UI\Bootstrap;

use Spell\UI\HTML\Tag;
use App\Pms\UI\Timeline;

/* @var $project \Data\Entity\Pms\Project */

$content = Tag::div('panel clearfix');

$viewForm = new \Spell\UI\Layout\View(__DIR__, 'form.php', compact('action'));

$form = Tag::div('col-md-12')->setContent($viewForm->render());

$timelineDiv = Tag::div('col-md-12')->setAttr('style', 'background-color: #ECF0F5; padding: 20px;');
$timeline = Tag::mk('ul', 'timeline');

$date = null;
foreach($posts as $data):
    $fDate = $data['dttCreated']->format('d/m/Y');
    if($date != $fDate):
        $date = $fDate;
        $timeline->appendChild(Timeline::date($fDate));
    endif;
    $timeline->appendChild(Timeline::row($data));
endforeach;
$timelineDiv->appendChild($timeline);
echo $content->appendChild($form)->appendChild($timelineDiv)->render();
