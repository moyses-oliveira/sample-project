<?php

namespace Data\Service\File;

use Eventviva\ImageResize;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;

/**
 * Gallery upload service
 *
 * @author moysesoliveira
 */
class Gallery {

    /**
     *
     * @var array 
     */
    public $path = [];

    /**
     *
     * @var array
     */
    private $sizeCollection = [];

    /**
     * 
     * @param array $path
     */
    public function __construct(array $path)
    {
        $this->path = $path;
    }

    public function upload(array $attach, ?int $width = null, ?int $height = null, $crop = false): string
    {
        $dir = [Route::getPath()];
        $ext = pathinfo($attach['name'], PATHINFO_EXTENSION);
        $filename = md5(uniqid()) . ".$ext";
        $src = array_merge($this->path, ['image', $filename]);
        Path::make(array_merge($dir, $this->path, ['image']));
        move_uploaded_file($attach['tmp_name'], Path::combine(array_merge($dir, $src)));
        $filepath = Path::combine($src, '/');
        $this->resize($filepath, $width, $height, $crop);

        foreach($this->sizeCollection as $size):
            /* @var $size \Data\Service\File\Size */
            $this->imageThumb($filepath, $size);
        endforeach;

        return Route::getRoot() . $filepath;
    }

    public function imageThumb($src, Size $size)
    {
        $dir = [Route::getPath()];
        $thumbPath = array_merge($dir, $this->path, [$size->getPath()]);
        Path::make($thumbPath);
        $thumb = Path::combine($thumbPath) . DIRECTORY_SEPARATOR . basename($src);
        $image = new ImageResize($src);
        if($size->isCrop())
            $image->crop($size->getWidth(), $size->getHeight());
        else
            $image->resizeToBestFit($size->getWidth(), $size->getHeight());
        
        $image->save($thumb);
    }

    public function resize(string $src, ?int $width = null, ?int $height = null, $crop = false)
    {
        if(!($width && $height))
            return;

        $image = new ImageResize($src);
        if($crop)
            $image->crop($width, $height);
        else
            $image->resizeToBestFit($width, $height);

        $image->save($src);
    }

    public static function toSize(string $src, string $size)
    {
        $path = explode('/', $src);
        $path[count($path) - 2] = $size;
        return implode('/', $path);
    }

    /**
     * 
     * @param string $path
     * @param string $width
     * @param string $height
     * @param bool $crop
     */
    public function addSize(string $path, string $width, string $height, bool $crop = false)
    {
        $this->sizeCollection[] = new Size($path, $width, $height, $crop);
    }

}
