<?php

use Spell\UI\HTML\Tag;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;

$default = Path::combine([Route::getRoot(), 'Public', 'application', 'sulinvest', 'img', 'no-image-1280x800.jpg'], '/');
$vrcImageSrc = $data['vrcImageSrc'] ?? $default;
$coverImage = Tag::div('file-uploader text-right');
$fUBtSpan = Tag::mk('span', 'btn btn-primary btn-sm fileinput-button');
$fUBtSpan->appendChild(Tag::mk('i', 'fa fa-folder'));
$fInput = Tag::mk('input')->setAttr('type', 'file')->setAttr('name', 'image')->setAttr('value', $vrcImageSrc);
$fUBtSpan->appendChild(Tag::mk('span'));
$fUBtSpan->appendChild($fInput);
$fUBtSpan->setAttr('style', 'margin-top: 1px;margin-right: 3px;');
$fUBtRemove = Tag::mk('span', 'btn btn-danger btn-sm unset-image');
$fUBtRemove->appendChild(Tag::mk('i', 'fa fa-times'));
$fUBtRemove->setAttr('data-default', $default);
$fUBtRemove->setAttr('style', 'position: relative;overflow: hidden;display: inline-block;margin-top: 1px;margin-right: 0;');

    
$coverImage->appendChild($fUBtRemove)->appendChild($fUBtSpan);
$coverImage->appendChild(Tag::mk('input')->setAttr('type', 'hidden')->setAttr('name', 'vrcImageSrc')->setAttr('value', $vrcImageSrc));
$coverImage->appendChild(Tag::mk('input')->setAttr('type', 'hidden')->setAttr('name', 'empty')->setAttr('value', json_encode($vrcImageSrc === $default)));
$pngTr = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
$bg = "background: url($vrcImageSrc) center center no-repeat;background-size: contain;";
$coverImage->appendChild(Tag::mk('img')->setAttr('src', $pngTr)->setAttr('style', 'max-height: 220px;width: 100%;border: 1px solid #aaa;margin-top: -32px;' . $bg));
$ep = Route::link(Route::getModule(), 'upload-image');
return Tag::div('col-xs-12')->setAttr('data-endpoint', $ep)->setAttr('id', 'cover-image')->appendChild($coverImage);
