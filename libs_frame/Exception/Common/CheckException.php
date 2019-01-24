<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 9:48
 */
namespace Exception\Common;

use Exception\BaseException;

class CheckException extends BaseException {
    public function __construct( $message, $code ) {
        parent::__construct( $message, $code );
        $this->tipName = '检查异常';
    }
}