<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/6 0006
 * Time: 15:23
 */
namespace Exception\Swoole;

use Exception\BaseException;

class ServerException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = 'SWOOLE服务异常';
    }
}