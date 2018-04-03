<?php

namespace Data\Service\File;

use Gumlet\ImageResize;
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
    public $dir = [];

    /**
     *
     * @var array
     */
    private $sizeCollection = [];

    /**
     * 
     * @param array $path
     */
    public function __construct(array $path = [])
    {
        $this->setDir([]);
        $this->setPath(array_merge($this->getDir(), $path));
    }

    public function setDir(array $dir)
    {
        $this->dir = $dir;
    }

    public function getDir(): array
    {
        return $this->dir;
    }

    public function setPath(array $path)
    {
        $this->path = $path;
    }

    public function getPath(): array
    {
        return $this->path;
    }
    
    public function upload(array $attach, ?int $width = null, ?int $height = null, $crop = false): string
    {
        $ext = pathinfo($attach['name'], PATHINFO_EXTENSION);
        $filename = md5(uniqid()) . ".$ext";
        $src = array_merge($this->getPath(), ['image', $filename]);
        Path::make(array_merge([Route::getPath()], $this->getPath(), ['image']));
        move_uploaded_file($attach['tmp_name'], Route::getPath() . DIRECTORY_SEPARATOR . Path::combine($src));
        return $this->process($src, $width, $height, $crop);
    }
    
    public function fromSrc(string $src, ?int $width = null, ?int $height = null, $crop = false) {
        $ext = pathinfo($src, PATHINFO_EXTENSION);
        $filename = md5(uniqid()) . ".$ext";
        $new = array_merge($this->getPath(), ['image', $filename]);
        Path::make(array_merge([Route::getPath()], $this->getPath(), ['image']));
        copy($src, Path::combine($new));
        return $this->process($new, $width, $height, $crop);
    }
    
    public function process(array $src, ?int $width = null, ?int $height = null, $crop = false) {
        $filepath = Path::combine($src, '/');
        $this->resize(Route::getPath()  . DIRECTORY_SEPARATOR . $filepath, $width, $height, $crop);
       
        foreach($this->sizeCollection as $size):
            /* @var $size \Data\Service\File\Size */
            $this->imageThumb(Route::getPath()  . DIRECTORY_SEPARATOR . $filepath, $size);
        endforeach;
        
        return $filepath;
    }

    public function imageThumb($src, Size $size)
    {
        $thumbPath = array_merge($this->path, [$size->getPath()]);
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

    
    public function getSizeCollection(): array {
        return $this->sizeCollection;
    }
}
