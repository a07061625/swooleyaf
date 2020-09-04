<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:06
 */
namespace SyException\ObjectStorage;

use SyException\BaseException;

class OssException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '阿里云对象存储异常';
    }
}
