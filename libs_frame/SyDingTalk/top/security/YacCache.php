<?php
/**
 * yac实现cache
 */
class YacCache implements iCache
{
    public $isEnable = true;

    public function __construct()
    {
        if (!extension_loaded('yac')) {
            $this->isEnable = false;
        }
    }

    public function getCache($key)
    {
        $key = md5($key);
        if ($this->isEnable) {
            $yac = new Yac();

            return $yac->get($key);
        }
        echo 'yac is not enable ,skip getCache';
    }

    public function setCache($key, $var)
    {
        $key = md5($key);
        if ($this->isEnable) {
            $yac = new Yac();
            $yac->set($key, $var);
        } else {
            echo 'yac is not enable ,skip setCache';
        }
    }
}
