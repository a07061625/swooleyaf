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
 * Class QCloudException
 * @package SyException\Vms
 */
class QCloudException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '腾讯云语音服务异常';
    }
}
