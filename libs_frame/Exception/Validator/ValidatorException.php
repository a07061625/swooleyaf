<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:35
 */
namespace Exception\Validator;

use Exception\BaseException;

class ValidatorException extends BaseException {
    public function __construct( $message, $code ) {
        parent::__construct( $message, $code );
        $this->tipName = '数据校验异常';
    }
}