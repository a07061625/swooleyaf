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
use SyPay\ConfigUnionChannels;
use SyPay\ConfigUnionQuickPass;
use SyTool\Tool;

/**
 * Trait PayConfigTrait
 *
 * @package SyTrait
 */
trait PayConfigTrait
{
    /**
     * 刷新银联支付全渠道配置信息
     *
     * @param string $merId
     *
     * @return \SyPay\ConfigUnionChannels
     *
     * @throws \SyException\Pay\UnionException
     */
    private function refreshUnionChannelsConfig(string $merId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_REFRESH;
        $unionChannelsConfig = new ConfigUnionChannels();
        $unionChannelsConfig->setMerId($merId);
        $unionChannelsConfig->setExpireTime($expireTime);

        //todo: 从数据库获取支付全渠道配置信息,如果配置信息不存在,设置$unionChannelsConfig->setValid(false);否则设置$unionChannelsConfig->setValid(true)和其他相关配置
        $this->unionChannelsConfigs[$merId] = $unionChannelsConfig;

        return $unionChannelsConfig;
    }

    /**
     * 刷新银联支付云闪付配置信息
     *
     * @param string $appId
     *
     * @return \SyPay\ConfigUnionQuickPass
     *
     * @throws \SyException\Pay\UnionException
     */
    private function refreshUnionQuickPassConfig(string $appId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_REFRESH;
        $unionQuickPassConfig = new ConfigUnionQuickPass();
        $unionQuickPassConfig->setAppId($appId);
        $unionQuickPassConfig->setExpireTime($expireTime);

        //todo: 从数据库获取支付配置信息,如果配置信息不存在,设置$unionQuickPassConfig->setValid(false);否则设置$unionQuickPassConfig->setValid(true)和其他相关配置
        $this->unionQuickPassConfigs[$appId] = $unionQuickPassConfig;

        return $unionQuickPassConfig;
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
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_REFRESH;
        $payPalConfig = new ConfigPayPal();
        $payPalConfig->setClientId($clientId);
        $payPalConfig->setExpireTime($expireTime);

        //todo: 从数据库获取支付配置信息,如果配置信息不存在,设置$payPalConfig->setValid(false);否则设置$payPalConfig->setValid(true)和其他相关配置
        $this->payPalConfigs[$clientId] = $payPalConfig;

        return $payPalConfig;
    }
}
