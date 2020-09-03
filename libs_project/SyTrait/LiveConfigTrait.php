<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace SyTrait;

use SyConstant\Project;
use SyLive\ConfigBaiJia;
use SyTool\Tool;

trait LiveConfigTrait
{
    /**
     * 更新百家云配置
     *
     * @param string $partnerId
     *
     * @return \SyLive\ConfigBaiJia
     *
     * @throws \SyException\Live\BaiJiaException
     */
    private function refreshBaiJiaConfig(string $partnerId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_LIVE_BAIJIA_REFRESH;
        $baiJiaConfig = new ConfigBaiJia();
        $baiJiaConfig->setExpireTime($expireTime);

        $configs = Tool::getConfig('live.' . SY_ENV . SY_PROJECT . '.baijia');
        $existId = (string)Tool::getArrayVal($configs, 'partner.id', '', true);
        if ($existId == $partnerId) {
            $baiJiaConfig->setValid(true);
            $baiJiaConfig->setPartnerId($existId);
            $baiJiaConfig->setSecretKey((string)Tool::getArrayVal($configs, 'secret.key', '', true));
            $baiJiaConfig->setPrivateDomain((string)Tool::getArrayVal($configs, 'private.domain', '', true));
        } else {
            $baiJiaConfig->setValid(false);
        }
        $this->baiJiaConfigs[$partnerId] = $baiJiaConfig;

        return $baiJiaConfig;
    }
}
