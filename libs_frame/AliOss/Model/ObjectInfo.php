<?php
namespace AliOss\Model;

class ObjectInfo {
    private $key = "";
    private $lastModified = "";
    private $eTag = "";
    private $type = "";
    private $size = 0;
    private $storageClass = "";

    /**
     * ObjectInfo constructor.
     * @param string $key
     * @param string $lastModified
     * @param string $eTag
     * @param string $type
     * @param int $size
     * @param string $storageClass
     */
    public function __construct($key, $lastModified, $eTag, $type, $size, $storageClass){
        $this->key = $key;
        $this->lastModified = $lastModified;
        $this->eTag = $eTag;
        $this->type = $type;
        $this->size = $size;
        $this->storageClass = $storageClass;
    }

    /**
     * @return string
     */
    public function getKey(){
        return $this->key;
    }

    /**
     * @return string
     */
    public function getLastModified(){
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function getETag(){
        return $this->eTag;
    }

    /**
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize(){
        return $this->size;
    }

    /**
     * @return string
     */
    public function getStorageClass(){
        return $this->storageClass;
    }
}