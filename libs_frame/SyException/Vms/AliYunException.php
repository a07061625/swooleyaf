<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 14:01
 */
namespace SyException\Vms;

use SyException\BaseException;

/**
 * Class AliYunException
 * @package SyException\Vms
 */
class AliYunException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '阿里云语音服务异常';
    }
}
