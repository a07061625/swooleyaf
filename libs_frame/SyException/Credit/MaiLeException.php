<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:09
 */
namespace SyException\Credit;

use SyException\BaseException;

/**
 * Class MaiLeException
 * @package SyException\Credit
 */
class MaiLeException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '麦乐积分异常';
    }
}
