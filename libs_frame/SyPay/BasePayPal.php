<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:41
 */
namespace SyPay;

/**
 * Class BasePayPal
 *
 * @package SyPay
 */
abstract class BasePayPal extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取接口域名
     *
     * @return string
     */
    protected function getApiDomain() : string
    {
        if ($this->envType == self::ENV_TYPE_PRODUCT) {
            return 'https://api.paypal.com';
        }

        return 'https://api.sandbox.paypal.com';
    }
}
