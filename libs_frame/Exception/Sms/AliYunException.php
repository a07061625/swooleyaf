<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-16
 * Time: 2:25
 */
namespace Exception\Sms;

use Exception\BaseException;

class AliYunException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = '阿里云短信异常';
    }
}