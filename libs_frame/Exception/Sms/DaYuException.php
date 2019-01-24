<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-16
 * Time: 2:25
 */
namespace Exception\Sms;

use Exception\BaseException;

class DaYuException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = '大鱼短信异常';
    }
}