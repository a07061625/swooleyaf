<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 15:58
 */
namespace SyTrait;

use SyConstant\Project;
use SyPay\ConfigPayPal;
use SyPay\ConfigUnion;
use SyTool\Tool;

/**
 * Trait PayConfigTrait
 *
 * @package SyTrait
 */
trait PayConfigTrait
{
    /**
     * 刷新银联支付配置信息
     *
     * @param string $merId
     *
     * @return \SyPay\ConfigUnion
     *
     * @throws \SyException\Pay\UnionException
     */
    private function refreshUnionConfig(string $merId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_PAY_UNION_REFRESH;
        $unionConfig = new ConfigUnion();
        $unionConfig->setMerId($merId);
        $unionConfig->setExpireTime($expireTime);

        //todo: 从数据库获取支付配置信息,如果配置信息不存在,设置$unionConfig->setValid(false);否则设置$unionConfig->setValid(true)和其他相关配置
        $this->unionConfigs[$merId] = $unionConfig;

        return $unionConfig;
    }

    /**
     * 刷新贝宝支付配置信息
     *
     * @param string $clientId
     *
     * @return \SyPay\ConfigPayPal
     *
     * @throws \SyException\Pay\PayPalException
     */
    private function refreshPayPalConfig(string $clientId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_PAY_PAYPAL_REFRESH;
        $payPalConfig = new ConfigPayPal();
        $payPalConfig->setClientId($clientId);
        $payPalConfig->setExpireTime($expireTime);

        //todo: 从数据库获取支付配置信息,如果配置信息不存在,设置$payPalConfig->setValid(false);否则设置$payPalConfig->setValid(true)和其他相关配置
        $this->payPalConfigs[$clientId] = $payPalConfig;

        return $payPalConfig;
    }
}
