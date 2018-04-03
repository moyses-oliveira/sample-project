<?php

namespace Data\Service\File;

/**
 * Description of ImageInfo
 *
 * @author moyses-oliveira
 */
class ImageInfo {
    
    /**
     *
     * @var string
     */
    private $src = '';
    
    /**
     *
     * @var string
     */
    private $mime = '';
    
    /**
     *
     * @var int
     */
    private $width = 0;
    
    /**
     *
     * @var int
     */
    private $height = 0;
    
    /**
     * 
     * @param string $src
     * @return type
     */
    public function __construct(string $src)
    {
        if(!$src)
            return;
        
        $this->src = $src;
        $info = [];
        $size = getimagesize($this->src, $info);
        $this->width = $size[0];
        $this->height = $size[1];
        $this->mime = $size['mime'];
    }
    
    /**
     * 
     * @return int
     */
    public function getWidth():int {
        return $this->width;
    }
    
    /**
     * 
     * @return int
     */
    public function getHeight():int {
        return $this->height;
    }
    
    /**
     * 
     * @return string
     */
    public function getMime(): string {
        return $this->mime;
    }
    
    /**
     * 
     * @return string
     */
    public function getSrc(): string {
        return $this->src;
    }
    
}
