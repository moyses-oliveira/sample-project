<?php

namespace Data\Service\File;

/**
 * Description of Size
 *
 * @author moysesoliveira
 */
class Size {

    /**
     *
     * @var string 
     */
    private $path = null;

    /**
     *
     * @var string 
     */
    private $width = null;

    /**
     *
     * @var string 
     */
    private $height = null;

    /**
     *
     * @var bool 
     */
    private $crop = null;

    /**
     * 
     * @param string $path
     * @param string $width
     * @param string $height
     */
    public function __construct(string $path, string $width, string $height, bool $crop = false)
    {
        $this->setPath($path);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->crop = $crop;
    }

    /**
     * 
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * 
     * @param string $width
     */
    public function setWidth(string $width)
    {
        $this->width = $width;
    }

    /**
     * 
     * @param string $height
     */
    public function setHeight(string $height)
    {
        $this->height = $height;
    }

    /**
     * 
     * @param string $height
     */
    public function doCrop()
    {
        $this->crop = true;
    }

    /**
     * 
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * 
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

    /**
     * 
     * @return string
     */
    public function getHeight(): string
    {
        return $this->height;
    }

    /**
     * 
     * @return string
     */
    public function isCrop(): string
    {
        return $this->crop;
    }

}
