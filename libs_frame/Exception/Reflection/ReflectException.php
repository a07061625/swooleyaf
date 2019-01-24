<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/23 0023
 * Time: 15:56
 */
namespace Exception\Reflection;

use Exception\BaseException;

class ReflectException extends BaseException {
    public function __construct( $message, $code ) {
        parent::__construct( $message, $code );
        $this->tipName = '反射异常';
    }
}