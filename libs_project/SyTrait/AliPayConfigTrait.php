<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace SyTrait;

use AliPay\PayConfig;
use Factories\SyBaseMysqlFactory;
use SyConstant\Project;
use SyTool\Tool;

trait AliPayConfigTrait
{
    /**
     * 更新支付配置
     *
     * @param string $appId
     *
     * @return \AliPay\PayConfig
     */
    public function refreshPayConfig(string $appId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_ALIPAY_REFRESH;
        $payConfig = new PayConfig();
        $payConfig->setAppId($appId);
        $payConfig->setExpireTime($expireTime);

        $aliConfigEntity = SyBaseMysqlFactory::getAliconfigPayEntity();
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
        $this->payConfigs[$appId] = $payConfig;

        return $payConfig;
    }
}
