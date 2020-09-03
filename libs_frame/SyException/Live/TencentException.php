<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 9:09
 */
namespace SyException\Live;

use SyException\BaseException;

/**
 * Class TencentException
 *
 * @package SyException\Live
 */
class TencentException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '腾讯云直播异常';
    }
}
