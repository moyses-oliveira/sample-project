<?php

namespace Data\Service;

/**
 *
 * @author moysesoliveira
 */
class Cookie {

    /**
     *
     * @var string 
     */
    private $name = '';

    /**
     *
     * @var array 
     */
    private $collection = [];

    public function __construct(string $name)
    {
        $this->name = $name;
        if(!isset($_COOKIE[$this->name]))
            setcookie($this->name, json_encode([]), time() + (86400 * 30), "/");

        $this->load();
    }

    public function set(array $collection)
    {
        $this->collection = $collection;
    }

    public function get(): array
    {
        return $this->collection;
    }

    public function load()
    {
        if(isset($_COOKIE[$this->name]))
            $this->collection = json_decode($_COOKIE[$this->name], true);
    }

    public function __destruct()
    {
        setcookie($this->name, json_encode($this->collection), time() + (86400 * 30), "/");
    }

}
