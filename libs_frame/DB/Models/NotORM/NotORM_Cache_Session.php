<?php
/**
 * Cache using $_SESSION["NotORM"]
 */
namespace DB\Models\NotORM;

class NotORM_Cache_Session implements NotORM_Cache
{
    public function load($key)
    {
        if (!isset($_SESSION['NotORM'][$key])) {
            return;
        }
        return $_SESSION['NotORM'][$key];
    }

    public function save($key, $data)
    {
        $_SESSION['NotORM'][$key] = $data;
    }
}
