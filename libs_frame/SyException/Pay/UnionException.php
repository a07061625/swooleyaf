<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 15:20
 */
namespace SyException\Pay;

use SyException\BaseException;

/**
 * Class UnionException
 *
 * @package SyException\Pay
 */
class UnionException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '银联支付异常';
    }
}
