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
 * Class ChiVoxException
 *
 * @package SyException\Vms
 */
class ChiVoxException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '驰声语音服务异常';
    }
}
