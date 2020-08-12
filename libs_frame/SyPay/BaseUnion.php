<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:42
 */
namespace SyPay;

/**
 * Class BaseUnion
 * @package SyPay
 */
abstract class BaseUnion extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取接口域名
     * @return string
     */
    protected function getApiDomain() : string
    {
        if ($this->envType == self::ENV_TYPE_PRODUCT) {
            return 'https://gateway.95516.com';
        } else {
            return 'https://gateway.test.95516.com';
        }
    }
}
