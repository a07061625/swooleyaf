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
 * Class XunFeiException
 *
 * @package SyException\Vms
 */
class XunFeiException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '科大讯飞语音服务异常';
    }
}
