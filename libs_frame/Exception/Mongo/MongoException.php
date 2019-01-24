<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/27 0027
 * Time: 14:05
 */
namespace Exception\Mongo;

use Exception\BaseException;

class MongoException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = 'Mongo异常';
    }
}