<?php

namespace Data\Service\File;

use Spell\Flash\Path;
use Data\Service\Aws\S3;
use Spell\MVC\Flash\Route;

/**
 * Gallery upload service
 *
 * @author moysesoliveira
 */
class GalleryS3 {

    /**
     *
     * @var array 
     */
    public $path = [];

    /**
     *
     * @var S3 
     */
    private $s3 = null;
    
    /**
     *
     * @var Gallery
     */
    private $gallery = null;
    
    
    /**
     * 
     * @param array $path
     */
    public function __construct(array $path, S3 $s3)
    {
        $this->path = $path;
        $this->s3 = $s3;
        $this->gallery = new Gallery([]);
    }
    
    public function getS3():S3 {
        return $this->s3;
    }
    
    public function getGallery(): Gallery
    {
        return $this->gallery;
    }

    public function upload(array $attach, ?int $width = null, ?int $height = null, $crop = false): string
    {
        $this->getGallery()->setPath(['tmp']);
        $src = Route::getPath()  . DIRECTORY_SEPARATOR . $this->getGallery()->upload($attach, $width, $height, $crop);
        foreach($this->getGallery()->getSizeCollection() as $size):
            $this->mkPath($this->path);
            $toPath = array_merge($this->path, [$size->getPath()]);
            $new = Gallery::toSize($src, $size->getPath());
            $this->getS3()->moveToPath($new, Path::combine($toPath, '/'));
        endforeach;
        $toPath = Path::combine(array_merge($this->path, ['image']), '/');
        $this->getS3()->moveToPath($src, $toPath);
        return Path::combine(array_merge($this->path, ['image', basename($src)]));
    }

    public function fromSrc(string $src, ?int $width = null, ?int $height = null, $crop = false): string
    {
        $this->getGallery()->setPath(['tmp']);
        $file = Route::getPath()  . DIRECTORY_SEPARATOR . $this->getGallery()->fromSrc($src, $width, $height, $crop);
        foreach($this->getGallery()->getSizeCollection() as $size):
            $this->mkPath($this->path);
            $toPath = array_merge($this->path, [$size->getPath()]);
            $new = Gallery::toSize($file, $size->getPath());
            $this->getS3()->moveToPath($new, Path::combine($toPath, '/'));
        endforeach;
        $toPath = Path::combine(array_merge($this->path, ['image']), '/');
        $this->getS3()->moveToPath($file, $toPath);
        return Path::combine(array_merge($this->path, ['image', basename($file)]));
    }
    
    public function addSize(string $path, string $width, string $height, bool $crop = false)
    {
        $this->getGallery()->addSize($path, $width, $height, $crop);
    }

    public function mkPath(array $stack)
    {
        $bucket = $this->getS3()->getBucket();
        $path = rtrim(implode('/', $stack), '/');
        $this->mkDir($bucket . $path);
        
        return $path;
    }

    public function mkDir($rawPath)
    {
        $bucket = $this->getS3()->getBucket();
        $path = substr($rawPath, strlen($bucket));
        $way = explode('/', $path);
        array_unshift($way, $bucket);
        $final = Path::combine($way);
        if(file_exists($final))
            return true;
        
        foreach ($way as $k => $v):
            $new_path = $bucket . '/' . Path::combine(array_slice($way, 0, $k + 1));
            $exists = file_exists($new_path);
            if ($exists && !is_dir($new_path))
                throw new \Exception('You are trying to create folder in a file address.');

            if (!$exists)
                mkdir($new_path);
            
        endforeach;
        return true;
    }

}
