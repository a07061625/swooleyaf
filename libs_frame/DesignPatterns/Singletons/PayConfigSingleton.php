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
use SyConstant\SyInner;
use SyException\Pay\PayPalException;
use SyException\Pay\UnionException;
use SyPay\PayPal\Core\PayPalHttpClient;
use SyPay\PayPal\Core\ProductionEnvironment;
use SyPay\PayPal\Core\SandboxEnvironment;
use SyTool\Tool;
use SyTrait\PayConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class PayConfigSingleton
 *
 * @package DesignPatterns\Singletons
 */
class PayConfigSingleton
{
    use SingletonTrait;
    use PayConfigTrait;

    /**
     * 银联支付全渠道配置列表
     *
     * @var array
     */
    private $unionChannelsConfigs = [];
    /**
     * 银联支付全渠道配置清理时间戳
     *
     * @var int
     */
    private $unionChannelsClearTime = 0;
    /**
     * 银联支付云闪付配置列表
     *
     * @var array
     */
    private $unionQuickPassConfigs = [];
    /**
     * 银联支付云闪付配置清理时间戳
     *
     * @var int
     */
    private $unionQuickPassClearTime = 0;
    /**
     * 贝宝支付配置列表
     *
     * @var array
     */
    private $payPalConfigs = [];
    /**
     * 贝宝支付配置清理时间戳
     *
     * @var int
     */
    private $payPalConfigClearTime = 0;
    /**
     * 贝宝支付客户端列表
     *
     * @var array
     */
    private $payPalClients = [];
    /**
     * 贝宝支付客户端清理时间戳
     *
     * @var int
     */
    private $payPalClientClearTime = 0;

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
     * 获取所有的银联支付全渠道配置
     *
     * @return array
     */
    public function getUnionChannelsConfigs()
    {
        return $this->unionChannelsConfigs;
    }

    /**
     * 获取银联支付全渠道配置
     *
     * @param string $merId
     *
     * @return \SyPay\ConfigUnionChannels
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getUnionChannelsConfig(string $merId)
    {
        $nowTime = Tool::getNowTime();
        $unionChannelsConfig = $this->getLocalUnionChannelsConfig($merId);
        if (is_null($unionChannelsConfig)) {
            $unionChannelsConfig = $this->refreshUnionChannelsConfig($merId);
        } elseif ($unionChannelsConfig->getExpireTime() < $nowTime) {
            $unionChannelsConfig = $this->refreshUnionChannelsConfig($merId);
        }

        if ($unionChannelsConfig->isValid()) {
            return $unionChannelsConfig;
        }

        throw new UnionException('银联支付全渠道配置不存在', ErrorCode::PAY_UNION_PARAM_ERROR);
    }

    /**
     * 移除银联支付全渠道配置
     *
     * @param string $merId
     */
    public function removeUnionChannelsConfig(string $merId)
    {
        unset($this->unionChannelsConfigs[$merId]);
    }

    /**
     * 获取所有的银联支付云闪付配置
     *
     * @return array
     */
    public function getUnionQuickPassConfigs()
    {
        return $this->unionQuickPassConfigs;
    }

    /**
     * 获取银联支付云闪付配置
     *
     * @param string $appId
     *
     * @return \SyPay\ConfigUnionQuickPass
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getUnionQuickPassConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        $unionQuickPassConfig = $this->getLocalUnionQuickPassConfig($appId);
        if (is_null($unionQuickPassConfig)) {
            $unionQuickPassConfig = $this->refreshUnionQuickPassConfig($appId);
        } elseif ($unionQuickPassConfig->getExpireTime() < $nowTime) {
            $unionQuickPassConfig = $this->refreshUnionQuickPassConfig($appId);
        }

        if ($unionQuickPassConfig->isValid()) {
            return $unionQuickPassConfig;
        }

        throw new UnionException('银联支付云闪付配置不存在', ErrorCode::PAY_UNION_PARAM_ERROR);
    }

    /**
     * 移除银联支付云闪付配置
     *
     * @param string $appId
     */
    public function removeUnionQuickPassConfig(string $appId)
    {
        unset($this->unionQuickPassConfigs[$appId]);
    }

    /**
     * 获取所有的贝宝支付配置
     *
     * @return array
     */
    public function getPayPalConfigs()
    {
        return $this->payPalConfigs;
    }

    /**
     * 获取贝宝支付配置
     *
     * @param string $clientId
     *
     * @return \SyPay\ConfigPayPal
     *
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
        }

        throw new PayPalException('贝宝支付配置不存在', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
    }

    /**
     * 移除贝宝支付配置
     *
     * @param string $clientId
     */
    public function removePayPalConfig(string $clientId)
    {
        unset($this->payPalConfigs[$clientId]);
    }

    /**
     * 获取所有的贝宝支付客户端
     *
     * @return array
     */
    public function getPayPalClients()
    {
        return $this->payPalClients;
    }

    /**
     * 获取贝宝支付客户端
     *
     * @param string $clientId
     *
     * @return \SyPay\PayPal\Core\PayPalHttpClient
     *
     * @throws \SyException\Pay\PayPalException
     */
    public function getPayPalClient(string $clientId)
    {
        $nowTime = Tool::getNowTime();
        $payPalClient = $this->getLocalPayPalClient($clientId);
        if (is_null($payPalClient)) {
            $payPalClient = $this->refreshPayPalClient($clientId);
        } elseif ($payPalClient->getExpireTime() < $nowTime) {
            $payPalClient = $this->refreshPayPalClient($clientId);
        }

        if ($payPalClient->isValid()) {
            return $payPalClient;
        }

        throw new PayPalException('贝宝支付客户端不存在', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
    }

    /**
     * 移除贝宝支付客户端
     *
     * @param string $clientId
     */
    public function removePayPalClient(string $clientId)
    {
        unset($this->payPalClients[$clientId]);
    }

    /**
     * 获取本地银联支付全渠道配置
     *
     * @param string $merId
     *
     * @return \SyPay\ConfigUnionChannels|null
     */
    private function getLocalUnionChannelsConfig(string $merId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->unionChannelsClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->unionChannelsConfigs as $eMerId => $unionChannelsConfig) {
                if ($unionChannelsConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eMerId;
                }
            }
            foreach ($delIds as $eMerId) {
                unset($this->unionChannelsConfigs[$eMerId]);
            }

            $this->unionChannelsClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_CLEAR;
        }

        return Tool::getArrayVal($this->unionChannelsConfigs, $merId, null);
    }

    /**
     * 获取本地银联支付云闪付配置
     *
     * @param string $appId
     *
     * @return \SyPay\ConfigUnionQuickPass|null
     */
    private function getLocalUnionQuickPassConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->unionQuickPassClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->unionQuickPassConfigs as $eAppId => $unionQuickPassConfig) {
                if ($unionQuickPassConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAppId;
                }
            }
            foreach ($delIds as $eAppId) {
                unset($this->unionQuickPassConfigs[$eAppId]);
            }

            $this->unionQuickPassClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_CLEAR;
        }

        return Tool::getArrayVal($this->unionQuickPassConfigs, $appId, null);
    }

    /**
     * 获取本地贝宝支付配置
     *
     * @param string $clientId
     *
     * @return \SyPay\ConfigPayPal|null
     */
    private function getLocalPayPalConfig(string $clientId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->payPalConfigClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->payPalConfigs as $eClientId => $payPalConfig) {
                if ($payPalConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eClientId;
                }
            }
            foreach ($delIds as $eClientId) {
                unset($this->payPalConfigs[$eClientId]);
            }

            $this->payPalConfigClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_CLEAR;
        }

        return Tool::getArrayVal($this->payPalConfigs, $clientId, null);
    }

    /**
     * 获取本地贝宝支付客户端
     *
     * @param string $clientId
     *
     * @return \SyPay\PayPal\Core\PayPalHttpClient|null
     */
    private function getLocalPayPalClient(string $clientId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->payPalClientClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->payPalClients as $eClientId => $payPalClient) {
                if ($payPalClient->getExpireTime() < $nowTime) {
                    $delIds[] = $eClientId;
                }
            }
            foreach ($delIds as $eClientId) {
                unset($this->payPalClients[$eClientId]);
            }

            $this->payPalClientClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_CLEAR;
        }

        return Tool::getArrayVal($this->payPalClients, $clientId, null);
    }

    /**
     * 刷新贝宝支付客户端信息
     *
     * @param string $clientId
     *
     * @return \SyPay\PayPal\Core\PayPalHttpClient
     *
     * @throws \SyException\Pay\PayPalException
     */
    private function refreshPayPalClient(string $clientId)
    {
        $payPalConfig = $this->getPayPalConfig($clientId);
        if (SY_PAY_PAYPAL_ENV == SyInner::PAY_PAYPAL_ENV_PRODUCT) {
            $env = new ProductionEnvironment($payPalConfig->getClientId(), $payPalConfig->getClientSecret());
        } elseif (SY_PAY_PAYPAL_ENV == SyInner::PAY_PAYPAL_ENV_SANDBOX) {
            $env = new SandboxEnvironment($payPalConfig->getClientId(), $payPalConfig->getClientSecret());
        } else {
            throw new PayPalException('环境类型不支持', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }

        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_REFRESH;
        $payPalClient = new PayPalHttpClient($env);
        $payPalClient->setValid(true);
        $payPalClient->setExpireTime($expireTime);
        $this->payPalClients[$clientId] = $payPalClient;

        return $payPalClient;
    }
}
