<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */

namespace SyTrait;

use Factories\SyBaseMysqlFactory;
use SyConstant\Project;
use SyTool\Tool;
use Wx\WxConfigAccount;
use Wx\WxConfigCorp;

trait WxConfigTrait
{
    /**
     * 更新账号配置
     *
     * @return \Wx\WxConfigAccount
     */
    private function refreshAccountConfig(string $appId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_WXACCOUNT_REFRESH;
        $accountConfig = new WxConfigAccount();
        $accountConfig->setAppId($appId);
        $accountConfig->setExpireTime($expireTime);

        $wxConfigEntity = SyBaseMysqlFactory::getWxconfigBaseEntity();
        $ormResult1 = $wxConfigEntity->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=? AND `status`=?', [$appId, Project::WX_CONFIG_STATUS_ENABLE]);
        $configInfo = $wxConfigEntity->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            $accountConfig->setValid(false);
        } else {
            $wxDefaultConfig = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wx');
            $templates = \strlen($configInfo['app_templates']) > 0 ? Tool::jsonDecode($configInfo['app_templates']) : [];
            $accountConfig->setValid(true);
            $accountConfig->setClientIp((string)$configInfo['app_clientip']);
            $accountConfig->setOriginId((string)$configInfo['origin_id']);
            $accountConfig->setSecret((string)$configInfo['app_secret']);
            $accountConfig->setPayMchId((string)$configInfo['pay_mchid']);
            $accountConfig->setPayKey((string)$configInfo['pay_key']);
            $accountConfig->setPayNotifyUrl($wxDefaultConfig['url']['notify']['default']);
            $accountConfig->setPayAuthUrl($wxDefaultConfig['url']['auth']['default']);
            $accountConfig->setSslCert((string)$configInfo['payssl_cert']);
            $accountConfig->setSslKey((string)$configInfo['payssl_key']);
            $accountConfig->setV3Key((string)$configInfo['v3_key']);
            $accountConfig->setV3SerialNo((string)$configInfo['v3_serialno']);
            $accountConfig->setV3Algorithm((string)$configInfo['v3_algorithm']);
            $accountConfig->setV3AssociatedData((string)$configInfo['v3_associateddata']);
            $accountConfig->setV3Nonce((string)$configInfo['v3_nonce']);
            $accountConfig->setV3CipherText((string)$configInfo['v3_ciphertext']);
            $accountConfig->setSslCompanyBank((string)$configInfo['payssl_companybank']);
            $accountConfig->setMerchantAppId((string)$configInfo['merchant_appid']);
            if (\is_array($templates)) {
                $accountConfig->setTemplates($templates);
            }
        }
        $this->accountConfigs[$appId] = $accountConfig;

        return $accountConfig;
    }

    /**
     * 更新企业微信配置
     *
     * @return \Wx\WxConfigCorp
     */
    private function refreshCorpConfig(string $corpId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_WXCORP_REFRESH;
        $corpConfig = new WxConfigCorp();
        $corpConfig->setCorpId($corpId);
        $corpConfig->setExpireTime($expireTime);

        $wxConfigEntity = SyBaseMysqlFactory::getWxconfigCorpEntity();
        $ormResult1 = $wxConfigEntity->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`corp_id`=? AND `status`=?', [$corpId, Project::WX_CONFIG_CORP_STATUS_ENABLE]);
        $configInfo = $wxConfigEntity->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            $corpConfig->setValid(false);
        } else {
            $wxCorpDefaultConfig = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.wxcorp');
            $agents = \strlen($configInfo['corp_agents']) > 0 ? Tool::jsonDecode($configInfo['corp_agents']) : [];
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
        $this->corpConfigs[$corpId] = $corpConfig;

        return $corpConfig;
    }
}
