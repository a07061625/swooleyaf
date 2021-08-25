<?php
/**
 * 支付宝配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 19:15
 */

namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;
use SyTrait\AliPayConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class AliPayConfigSingleton
 *
 * @package DesignPatterns\Singletons
 *
 * @deprecated 建议使用\DesignPatterns\Singletons\SyAliPayConfigSingleton
 */
class AliPayConfigSingleton
{
    use SingletonTrait;
    use AliPayConfigTrait;

    /**
     * 支付配置列表
     *
     * @var array
     */
    private $payConfigs = [];
    /**
     * 支付配置清理时间戳
     *
     * @var int
     */
    private $payClearTime = 0;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\AliPayConfigSingleton
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取所有的支付配置
     *
     * @return array
     */
    public function getPayConfigs()
    {
        return $this->payConfigs;
    }

    /**
     * 获取支付配置
     *
     * @return \AliPay\PayConfig
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function getPayConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        $payConfig = $this->getLocalPayConfig($appId);
        if (null === $payConfig) {
            $payConfig = $this->refreshPayConfig($appId);
        } elseif ($payConfig->getExpireTime() < $nowTime) {
            $payConfig = $this->refreshPayConfig($appId);
        }

        if ($payConfig->isValid()) {
            return $payConfig;
        }

        throw new AliPayPayException('支付配置不存在', ErrorCode::ALIPAY_PARAM_ERROR);
    }

    /**
     * 移除支付配置
     */
    public function removePayConfig(string $appId)
    {
        unset($this->payConfigs[$appId]);
    }

    /**
     * 获取本地支付配置
     *
     * @return null|\AliPay\PayConfig
     */
    private function getLocalPayConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->payClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->payConfigs as $eAppId => $payConfig) {
                if ($payConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAppId;
                }
            }
            foreach ($delIds as $eAppId) {
                unset($this->payConfigs[$eAppId]);
            }

            $this->payClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_ALIPAY_CLEAR;
        }

        return Tool::getArrayVal($this->payConfigs, $appId, null);
    }
}
