<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/23 0023
 * Time: 18:00
 */
namespace Exception\Validator;

use Exception\BaseException;

class SignException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = '签名异常';
    }
}