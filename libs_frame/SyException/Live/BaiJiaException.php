<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 10:14
 */
namespace SyException\Live;

use SyException\BaseException;

/**
 * Class BaiJiaException
 * @package SyException\Live
 */
class BaiJiaException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '百家云直播异常';
    }
}
