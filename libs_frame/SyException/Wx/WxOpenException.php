<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-3-31
 * Time: 上午11:14
 */
namespace SyException\Wx;

use SyException\BaseException;

class WxOpenException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '微信开放平台异常';
    }
}
