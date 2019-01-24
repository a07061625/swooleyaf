<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-3
 * Time: 下午3:05
 */
namespace DB\Models\NotORM;

interface NotORM_Cache {
    /**
     * Load stored data
     * @param string
     * @return mixed or null if not found
     */
    function load($key);

    /**
     * Save data
     * @param string
     * @param mixed
     * @return null
     */
    function save($key, $data);
}