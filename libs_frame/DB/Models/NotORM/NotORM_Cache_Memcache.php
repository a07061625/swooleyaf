<?php
/**
 * Cache using "NotORM." prefix in Memcache
 */
namespace DB\Models\NotORM;

class NotORM_Cache_Memcache implements NotORM_Cache
{
    private $memcache;

    public function __construct(\Memcache $memcache)
    {
        $this->memcache = $memcache;
    }

    public function load($key)
    {
        $return = $this->memcache->get("NotORM.$key");
        if ($return === false) {
            return;
        }
        return $return;
    }

    public function save($key, $data)
    {
        $this->memcache->set("NotORM.$key", $data);
    }
}
