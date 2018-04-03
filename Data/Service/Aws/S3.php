<?php

namespace Data\Service\Aws;

use Spell\MVC\Flash\Route;
use Spell\Flash\Path;

/**
 *
 * @author moysesoliveira
 */
class S3 {

    private $bucket;


    public function __construct($conf)
    {
        $sdk = new \Aws\Sdk($conf);
        $sdk->createClient('s3')->registerStreamWrapper();
        $this->bucket =  's3://' . $conf['bucket'];
    }
    
    public function copyToPath(string $filename, string $toPath) {
        
        if(!file_exists($filename))
            throw new \Exception('The file  "'. $filename .'" can\'t be opened!');
        
        $content = file_get_contents($filename);
        $name = pathinfo($filename, PATHINFO_BASENAME);
        if (!$content)
            throw new \Exception('This file can\'t be created!');
        
        file_put_contents(Path::combine([$this->getBucket(), $toPath, $name]), $content);
    }
    
    public function moveToPath(string $filename, string $toPath) {
        $this->copyToPath($filename, $toPath);
        unlink($filename);
    }
    
    public function getBucket() {
        return $this->bucket;
    }
}
