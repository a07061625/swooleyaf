<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-3-31
 * Time: 上午11:14
 */
namespace SyException\Wx;

use SyException\BaseException;

class WxCorpProviderException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '微信企业服务商异常';
    }
}
