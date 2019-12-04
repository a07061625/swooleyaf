<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 16:41
 */
namespace SyException\Currency;

use SyException\BaseException;

class AliMarketYiYuanException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '阿里云市场易源货币异常';
    }
}
