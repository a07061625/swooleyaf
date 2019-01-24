<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/23 0023
 * Time: 14:00
 */
namespace Exception\User;

use Exception\BaseException;

class LoginException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = '登录异常';
    }
}