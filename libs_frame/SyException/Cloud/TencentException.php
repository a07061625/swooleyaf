<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:23
 */
namespace SyException\Cloud;

use SyException\BaseException;

/**
 * Class TencentException
 *
 * @package SyException\Cloud
 */
class TencentException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '腾讯云异常';
    }
}
