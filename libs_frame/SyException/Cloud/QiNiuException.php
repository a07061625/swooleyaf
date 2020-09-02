<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:31
 */
namespace SyException\Cloud;

use SyException\BaseException;

/**
 * Class QiNiuException
 *
 * @package SyException\Cloud
 */
class QiNiuException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '七牛云异常';
    }
}
