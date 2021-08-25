<?php
/**
 * 支付宝配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 19:15
 */

namespace DesignPatterns\Singletons;

use SyAliPay\AopClient;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;
use SyTrait\SingletonTrait;
use SyTrait\SyAliPayConfigTrait;

class SyAliPayConfigSingleton
{
    use SingletonTrait;
    use SyAliPayConfigTrait;

    /**
     * 客户端列表
     *
     * @var array
     */
    private $clients = [];
    /**
     * 客户端清理时间戳
     *
     * @var int
     */
    private $clientClearTime = 0;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\SyAliPayConfigSingleton
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取所有的客户端列表
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * 获取客户端
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function getClient(string $appId): ?AopClient
    {
        $nowTime = Tool::getNowTime();
        $payConfig = $this->getLocalClient($appId);
        if (null === $payConfig) {
            $payConfig = $this->refreshClient($appId);
        } elseif ($payConfig->getSyExpireTime() < $nowTime) {
            $payConfig = $this->refreshClient($appId);
        }

        if ($payConfig->isSyValid()) {
            return $payConfig;
        }

        throw new AliPayPayException('客户端不存在', ErrorCode::ALIPAY_PARAM_ERROR);
    }

    /**
     * 移除客户端
     */
    public function removeClient(string $appId)
    {
        unset($this->clients[$appId]);
    }

    /**
     * 获取本地支付配置
     */
    private function getLocalClient(string $appId): ?AopClient
    {
        $nowTime = Tool::getNowTime();
        if ($this->clientClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->clients as $eAppId => $eClient) {
                if ($eClient->getSyExpireTime() < $nowTime) {
                    $delIds[] = $eAppId;
                }
            }
            foreach ($delIds as $eAppId) {
                unset($this->clients[$eAppId]);
            }

            $this->clientClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_SY_ALIPAY_CLEAR;
        }

        return Tool::getArrayVal($this->clients, $appId, null);
    }
}
