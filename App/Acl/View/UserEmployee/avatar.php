<?php

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;

$agent = Path::combine([Route::getRoot(), 'Public', 'img', 'agent.png'], '/');
$vrcImage = $data['vrcImage'] ?? $agent;
$avatar = Tag::div('file-uploader')->setAttr('style', 'width: 150px; margin: 0 auto;');
$fUBtSpan = Tag::mk('span', 'btn btn-success fileinput-button col-xs-12');
$fUBtSpan->appendChild(Tag::mk('i', 'fa fa-folder'));
$fInput = Tag::mk('input')->setAttr('type', 'file')->setAttr('name', 'avatar')->setAttr('value', $vrcImage);
$fUBtSpan->appendChild(Tag::mk('span'));
$fUBtSpan->appendChild($fInput);

$avatar->appendChild($fUBtSpan);
$avatar->appendChild(Tag::mk('input')->setAttr('type', 'hidden')->setAttr('name', 'vrcImage')->setAttr('value', $vrcImage));
$pngTr = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
$bg = "background: url($vrcImage) center center no-repeat;background-size: contain;";
$avatar->appendChild(Tag::mk('img')->setAttr('src', $pngTr)->setAttr('style', 'width: 150px; height: 150px; ' . $bg));
return Tag::div('')->setAttr('id', 'avatar')->appendChild($avatar);
