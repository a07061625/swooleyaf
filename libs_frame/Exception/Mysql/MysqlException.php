<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:26
 */
namespace Exception\Mysql;

use Exception\BaseException;

class MysqlException extends BaseException {
    public function __construct( $message, $code ) {
        parent::__construct( $message, $code );
        $this->tipName = 'MYSQL异常';
    }
}