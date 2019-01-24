<?php
/**
 * Cache using "NotORM." prefix in APC
 */
namespace DB\Models\NotORM;

class NotORM_Cache_APC implements NotORM_Cache {
    function load($key) {
        $return = apc_fetch("NotORM.$key", $success);
        if (!$success) {
            return null;
        }
        return $return;
    }

    function save($key, $data) {
        apc_store("NotORM.$key", $data);
    }
}