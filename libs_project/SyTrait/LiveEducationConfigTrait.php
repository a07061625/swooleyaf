<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */
namespace SyTrait;

use LiveEducation\ConfigBJY;
use SyConstant\Project;
use SyTool\Tool;

trait LiveEducationConfigTrait
{
    /**
     * 更新百家云配置
     * @param string $partnerId
     * @return \LiveEducation\ConfigBJY
     */
    private function refreshBJYConfig(string $partnerId)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_LIVE_EDUCATION_BJY_REFRESH;
        $bjyConfig = new ConfigBJY();
        $bjyConfig->setExpireTime($expireTime);

        $configs = Tool::getConfig('liveeducation.' . SY_ENV . SY_PROJECT . '.bjy');
        $existId = (string)Tool::getArrayVal($configs, 'partner.id', '', true);
        if($existId == $partnerId){
            $bjyConfig->setValid(true);
            $bjyConfig->setPartnerId($existId);
            $bjyConfig->setSecretKey((string)Tool::getArrayVal($configs, 'secret.key', '', true));
            $bjyConfig->setPrivateDomain((string)Tool::getArrayVal($configs, 'private.domain', '', true));
        } else {
            $bjyConfig->setValid(false);
        }
        $this->bjyConfigs[$partnerId] = $bjyConfig;

        return $bjyConfig;
    }
}
