<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 15:43
 */
namespace Exception\Redis;

use Exception\BaseException;

class RedisException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = 'REDIS异常';
    }
}