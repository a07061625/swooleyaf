<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:30
 */
namespace SyException\Logistics;

use SyException\BaseException;

class KdNiaoException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '快递鸟物流异常';
    }
}
