<?php

namespace App\Pms\UI;

use Spell\UI\HTML\Tag;

/**
 * Description of Timeline
 *
 * @author moysesoliveira
 */
class Timeline {

    public static function date(string $date)
    {
        $timeSpan = Tag::mk('span', 'bg-green')->setContent($date);
        return Tag::mk('li', 'time-label h4')->appendChild($timeSpan);
    }

    public static function row(array $data)
    {
        switch($data['enmType']):
            case 'TEXT':
                return static::textRow($data);
        endswitch;
    }

    private static function textRow(array $data)
    {
        $strTime = $data['dttCreated']->format('H:i:s');
        $row = Tag::mk('li');
        $row->appendChild(Tag::mk('i', 'fa fa-envelope bg-blue'));
        $div = Tag::mk('div ', 'timeline-item'); 
            $time = Tag::mk('span', 'time')->appendChild(Tag::mk('i', 'fa fa-clock-o'))->setContent($strTime);
            $headerTitle = sprintf('<a href="#">%s</a> sent an message', $data['vrcName']);
            $header = Tag::mk('h3', 'timeline-header')->setContent($headerTitle);
            $title = Tag::mk('h2', 'timeline-header')->setContent($data['vrcTitle']);
            $body = Tag::div('timeline-body')->setContent($data['txtNote']);
            $footer = Tag::div('timeline-footer');
            $footer->appendChild(Tag::mk('a', 'btn btn-primary btn-xs')->setContent('Edit'));
            $footer->appendChild(Tag::mk('a', 'btn btn-danger btn-xs')->setContent('Delete'));
        $div->appendChild($time)
            ->appendChild($header)
            ->appendChild($title)
            ->appendChild($body)
            ->appendChild($footer);
        return $row->appendChild($div);
    }

}