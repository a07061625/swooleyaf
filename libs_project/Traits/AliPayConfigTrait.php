<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace Traits;

use AliPay\PayConfig;
use Constant\Project;
use Factories\SyBaseMysqlFactory;
use Tool\Tool;

trait AliPayConfigTrait
{
    /**
     * 支付配置列表
     * @var array
     */
    private $payConfigs = [];

    /**
     * 支付配置清理时间戳
     * @var int
     */
    private $payClearTime = 0;

    /**
     * 更新支付配置
     * @param string $appId
     * @return \AliPay\PayConfig
     */
    public function refreshPayConfig(string $appId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_ALIPAY_REFRESH;
        $payConfig = new PayConfig();
        $payConfig->setAppId($appId);
        $payConfig->setExpireTime($expireTime);

        $aliConfigEntity = SyBaseMysqlFactory::AliconfigPayEntity();
        $ormResult1 = $aliConfigEntity->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=? AND `status`=?', [$appId, Project::ALI_PAY_STATUS_ENABLE]);
        $configInfo = $aliConfigEntity->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            $payConfig->setValid(false);
        } else {
            $payConfig->setValid(true);
            $payConfig->setSellerId((string)$configInfo['app_id']);
            $payConfig->setUrlNotify((string)$configInfo['url_notify']);
            $payConfig->setUrlReturn((string)$configInfo['url_return']);
            $payConfig->setPriRsaKey((string)$configInfo['prikey_rsa']);
            $payConfig->setPubRsaKey((string)$configInfo['pubkey_rsa']);
            $payConfig->setPubAliKey((string)$configInfo['pubkey_ali']);
        }
        unset($configInfo, $ormResult1, $aliConfigEntity);
        $this->payConfigs[$appId] = $payConfig;

        return $payConfig;
    }

    /**
     * 获取支付配置
     * @param string $appId
     * @return \AliPay\PayConfig|null
     */
    public function getPayConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        $payConfig = $this->getLocalPayConfig($appId);
        if (is_null($payConfig)) {
            $payConfig = $this->refreshPayConfig($appId);
        } elseif ($payConfig->getExpireTime() < $nowTime) {
            $payConfig = $this->refreshPayConfig($appId);
        }

        return $payConfig->isValid() ? $payConfig : null;
    }

    /**
     * 移除支付配置
     * @param string $appId
     */
    public function removePayConfig(string $appId)
    {
        unset($this->payConfigs[$appId]);
    }

    /**
     * 获取本地支付配置
     * @param string $appId
     * @return \AliPay\PayConfig|null
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
