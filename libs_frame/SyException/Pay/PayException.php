<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 15:18
 */
namespace SyException\Pay;

use SyException\BaseException;

/**
 * Class PayException
 *
 * @package SyException\Pay
 */
class PayException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '支付异常';
    }
}
