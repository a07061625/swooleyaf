<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/4/11 0011
 * Time: 18:46
 */
namespace SyException\Session;

use SyException\BaseException;

class JwtException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'JWT会话异常';
    }
}
