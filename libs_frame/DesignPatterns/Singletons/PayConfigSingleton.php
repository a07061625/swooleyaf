<?php
/**
 * 支付配置单例类
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 15:56
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Pay\PayPalException;
use SyException\Pay\UnionException;
use SyTool\Tool;
use SyTrait\PayConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class PayConfigSingleton
 * @package DesignPatterns\Singletons
 */
class PayConfigSingleton
{
    use SingletonTrait;
    use PayConfigTrait;

    /**
     * 贝宝支付配置列表
     * @var array
     */
    private $payPalConfigs = [];
    /**
     * 贝宝支付配置清理时间戳
     * @var int
     */
    private $payPalClearTime = 0;
    /**
     * 银联支付配置列表
     * @var array
     */
    private $unionConfigs = [];
    /**
     * 银联支付配置清理时间戳
     * @var int
     */
    private $unionClearTime = 0;

    /**
     * @return \DesignPatterns\Singletons\PayConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取所有的银联支付配置
     * @return array
     */
    public function getUnionConfigs()
    {
        return $this->unionConfigs;
    }

    /**
     * 获取本地银联支付配置
     * @param string $merId
     * @return \SyPay\ConfigUnion|null
     */
    private function getLocalUnionConfig(string $merId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->unionClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->unionConfigs as $eMerId => $unionConfig) {
                if ($unionConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eMerId;
                }
            }
            foreach ($delIds as $eMerId) {
                unset($this->unionConfigs[$eMerId]);
            }

            $this->unionClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_PAY_UNION_CLEAR;
        }

        return Tool::getArrayVal($this->unionConfigs, $merId, null);
    }

    /**
     * 获取银联支付配置
     * @param string $merId
     * @return \SyPay\ConfigUnion
     * @throws \SyException\Pay\UnionException
     */
    public function getUnionConfig(string $merId)
    {
        $nowTime = Tool::getNowTime();
        $unionConfig = $this->getLocalUnionConfig($merId);
        if (is_null($unionConfig)) {
            $unionConfig = $this->refreshUnionConfig($merId);
        } elseif ($unionConfig->getExpireTime() < $nowTime) {
            $unionConfig = $this->refreshUnionConfig($merId);
        }

        if ($unionConfig->isValid()) {
            return $unionConfig;
        } else {
            throw new UnionException('银联支付配置不存在', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * 移除银联支付配置
     * @param string $merId
     */
    public function removeUnionConfig(string $merId)
    {
        unset($this->unionConfigs[$merId]);
    }

    /**
     * 获取所有的贝宝支付配置
     * @return array
     */
    public function getPayPalConfigs()
    {
        return $this->payPalConfigs;
    }

    /**
     * 获取本地贝宝支付配置
     * @param string $clientId
     * @return \SyPay\ConfigPayPal|null
     */
    private function getLocalPayPalConfig(string $clientId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->payPalClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->payPalConfigs as $eClientId => $payPalConfig) {
                if ($payPalConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eClientId;
                }
            }
            foreach ($delIds as $eClientId) {
                unset($this->payPalConfigs[$eClientId]);
            }

            $this->payPalClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLEAR;
        }

        return Tool::getArrayVal($this->payPalConfigs, $clientId, null);
    }

    /**
     * 获取贝宝支付配置
     * @param string $clientId
     * @return \SyPay\ConfigPayPal
     * @throws \SyException\Pay\PayPalException
     */
    public function getPayPalConfig(string $clientId)
    {
        $nowTime = Tool::getNowTime();
        $payPalConfig = $this->getLocalPayPalConfig($clientId);
        if (is_null($payPalConfig)) {
            $payPalConfig = $this->refreshPayPalConfig($clientId);
        } elseif ($payPalConfig->getExpireTime() < $nowTime) {
            $payPalConfig = $this->refreshPayPalConfig($clientId);
        }

        if ($payPalConfig->isValid()) {
            return $payPalConfig;
        } else {
            throw new PayPalException('贝宝支付配置不存在', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    /**
     * 移除贝宝支付配置
     * @param string $clientId
     */
    public function removePayPalConfig(string $clientId)
    {
        unset($this->payPalConfigs[$clientId]);
    }
}
