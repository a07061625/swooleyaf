<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-3
 * Time: 下午3:12
 */
namespace DB\Models\NotORM;

interface JsonSerializable {
    function jsonSerialize();
}