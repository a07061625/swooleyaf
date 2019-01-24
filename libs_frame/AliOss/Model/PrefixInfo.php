<?php
namespace AliOss\Model;

class PrefixInfo {
    private $prefix;

    /**
     * PrefixInfo constructor.
     * @param string $prefix
     */
    public function __construct($prefix){
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getPrefix(){
        return $this->prefix;
    }
}