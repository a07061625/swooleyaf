<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace Traits;

use Constant\Project;
use Factories\SyTaskMysqlFactory;
use Tool\Tool;
use Wx\WxConfigAccount;
use Wx\WxConfigCorp;

trait WxConfigTrait
{
    /**
     * 账号配置列表
     * @var array
     */
    private $accountConfigs = [];
    /**
     * 账号配置清理时间戳
     * @var int
     */
    private $accountClearTime = 0;
    /**
     * 企业微信配置列表
     * @var array
     */
    private $corpConfigs = [];
    /**
     * 企业微信配置清理时间戳
     * @var int
     */
    private $corpClearTime = 0;

    /**
     * 获取所有的账号配置
     * @return array
     */
    public function getAccountConfigs()
    {
        return $this->accountConfigs;
    }

    /**
     * 获取账号配置
     * @param string $appId
     * @return \Wx\WxConfigAccount|null
     */
    public function getShopConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        $accountConfig = $this->getLocalAccountConfig($appId);
        if (is_null($accountConfig)) {
            $accountConfig = $this->refreshAccountConfig($appId);
        } elseif ($accountConfig->getExpireTime() < $nowTime) {
            $accountConfig = $this->refreshAccountConfig($appId);
        }

        return $accountConfig->isValid() ? $accountConfig : null;
    }

    /**
     * 移除账号配置
     * @param string $appId
     */
    public function removeAccountConfig(string $appId)
    {
        unset($this->accountConfigs[$appId]);
    }

    /**
     * 获取所有的企业微信配置
     * @return array
     */
    public function getCorpConfigs()
    {
        return $this->corpConfigs;
    }

    /**
     * 获取企业微信配置
     * @param string $corpId
     * @return \Wx\WxConfigCorp|null
     */
    public function getCorpConfig(string $corpId)
    {
        $nowTime = Tool::getNowTime();
        $corpConfig = $this->getLocalCorpConfig($corpId);
        if (is_null($corpConfig)) {
            $corpConfig = $this->refreshCorpConfig($corpId);
        } elseif ($corpConfig->getExpireTime() < $nowTime) {
            $corpConfig = $this->refreshCorpConfig($corpId);
        }

        return $corpConfig->isValid() ? $corpConfig : null;
    }

    /**
     * 移除企业微信配置
     * @param string $corpId
     */
    public function removeCorpConfig(string $corpId)
    {
        unset($this->corpConfigs[$corpId]);
    }

    /**
     * 获取本地账号配置
     * @param string $appId
     * @return \Wx\WxConfigAccount|null
     */
    private function getLocalAccountConfig(string $appId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->accountClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->accountConfigs as $eAppId => $accountConfig) {
                if ($accountConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eAppId;
                }
            }
            foreach ($delIds as $eAppId) {
                unset($this->accountConfigs[$eAppId]);
            }

            $this->accountClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXACCOUNT_CLEAR;
        }

        return Tool::getArrayVal($this->accountConfigs, $appId, null);
    }

    /**
     * 更新账号配置
     * @param string $appId
     * @return \Wx\WxConfigAccount
     */
    private function refreshAccountConfig(string $appId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_WXACCOUNT_REFRESH;
        $accountConfig = new WxConfigAccount();
        $accountConfig->setAppId($appId);
        $accountConfig->setExpireTime($expireTime);

        $wxConfigEntity = SyBaseMysqlFactory::WxconfigBaseEntity();
        $ormResult1 = $wxConfigEntity->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=? AND `status`=?', [$appId, Project::WX_CONFIG_STATUS_ENABLE]);
        $configInfo = $wxConfigEntity->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            $accountConfig->setValid(false);
        } else {
            $wxDefaultConfig = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wx');
            $templates = strlen($configInfo['app_templates']) > 0 ? Tool::jsonDecode($configInfo['app_templates']) : [];
            $accountConfig->setValid(true);
            $accountConfig->setClientIp((string)$configInfo['app_clientip']);
            $accountConfig->setSecret((string)$configInfo['app_secret']);
            $accountConfig->setPayMchId((string)$configInfo['pay_mchid']);
            $accountConfig->setPayKey((string)$configInfo['pay_key']);
            $accountConfig->setPayNotifyUrl($wxDefaultConfig['url']['notify']['default']);
            $accountConfig->setPayAuthUrl($wxDefaultConfig['url']['auth']['default']);
            $accountConfig->setSslCert((string)$configInfo['payssl_cert']);
            $accountConfig->setSslKey((string)$configInfo['payssl_key']);
            $accountConfig->setSslCompanyBank((string)$configInfo['payssl_companybank']);
            $accountConfig->setMerchantAppId((string)$configInfo['merchant_appid']);
            $accountConfig->setMerchantMchId((string)$configInfo['merchant_mchid']);
            if (is_array($templates)) {
                $accountConfig->setTemplates($templates);
            }
        }
        unset($configInfo, $ormResult1, $wxConfigEntity);

        $this->accountConfigs[$appId] = $accountConfig;

        return $accountConfig;
    }

    /**
     * 获取本地企业微信配置
     * @param string $corpId
     * @return \Wx\WxConfigCorp|null
     */
    private function getLocalCorpConfig(string $corpId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->corpClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->corpConfigs as $eCorpId => $corpConfig) {
                if ($corpConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eCorpId;
                }
            }
            foreach ($delIds as $eCorpId) {
                unset($this->corpConfigs[$eCorpId]);
            }

            $this->corpClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_WXCORP_CLEAR;
        }

        return Tool::getArrayVal($this->corpConfigs, $corpId, null);
    }

    /**
     * 更新企业微信配置
     * @param string $corpId
     * @return \Wx\WxConfigCorp
     */
    private function refreshCorpConfig(string $corpId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_WXCORP_REFRESH;
        $corpConfig = new WxConfigCorp();
        $corpConfig->setCorpId($corpId);
        $corpConfig->setExpireTime($expireTime);

        $wxConfigEntity = SyTaskMysqlFactory::WxconfigCorpEntity();
        $ormResult1 = $wxConfigEntity->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`corp_id`=? AND `status`=?', [$corpId, Project::WX_CONFIG_CORP_STATUS_ENABLE]);
        $configInfo = $wxConfigEntity->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            $corpConfig->setValid(false);
        } else {
            $wxCorpDefaultConfig = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wxcorp');
            $agents = strlen($configInfo['corp_agents']) > 0 ? Tool::jsonDecode($configInfo['corp_agents']) : [];
            $corpConfig->setValid(true);
            $corpConfig->setClientIp((string)$configInfo['corp_clientip']);
            $corpConfig->setPayMchId((string)$configInfo['pay_mchid']);
            $corpConfig->setPayKey((string)$configInfo['pay_key']);
            $corpConfig->setPayNotifyUrl($wxCorpDefaultConfig['url']['notify']['default']);
            $corpConfig->setPayAuthUrl($wxCorpDefaultConfig['url']['auth']['default']);
            $corpConfig->setSslCert((string)$configInfo['payssl_cert']);
            $corpConfig->setSslKey((string)$configInfo['payssl_key']);
            $corpConfig->setAgents($agents);
        }
        unset($configInfo, $ormResult1, $wxConfigEntity);
        $this->corpConfigs[$corpId] = $corpConfig;

        return $corpConfig;
    }
}
