<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-11-27
 * Time: 下午11:28
 */
namespace Exception\Common;

use Exception\BaseException;

class ErrorException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = '错误异常';
    }
}