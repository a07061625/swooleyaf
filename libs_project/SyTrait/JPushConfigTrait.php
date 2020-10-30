<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 17:24
 */
namespace SyTrait;

use SyConstant\Project;
use SyMessagePush\ConfigJPushApp;
use SyMessagePush\ConfigJPushGroup;
use SyTool\Tool;

trait JPushConfigTrait
{
    /**
     * @param string $key
     *
     * @return \SyMessagePush\ConfigJPushApp
     */
    private function refreshJPushAppConfig(string $key)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_JPUSH_APP_REFRESH;
        $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
        $appKey = (string)Tool::getArrayVal($configs, 'jpush.app.key', '', true);
        $masterSecret = (string)Tool::getArrayVal($configs, 'jpush.master.secret', '', true);
        $appConfig = new ConfigJPushApp();
        $appConfig->setKeyAndSecret($appKey, $masterSecret);
        $appConfig->setExpireTime($expireTime);
        $appConfig->setValid(true);
        $this->jPushAppConfigs[$appKey] = $appConfig;

        return $appConfig;
    }

    /**
     * @param string $key
     *
     * @return \SyMessagePush\ConfigJPushGroup
     */
    private function refreshJPushGroupConfig(string $key)
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_JPUSH_GROUP_REFRESH;
        $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
        $groupKey = (string)Tool::getArrayVal($configs, 'jpush.group.key', '', true);
        $groupSecret = (string)Tool::getArrayVal($configs, 'jpush.group.secret', '', true);
        $groupConfig = new ConfigJPushGroup();
        $groupConfig->setKeyAndSecret($groupKey, $groupSecret);
        $groupConfig->setExpireTime($expireTime);
        $groupConfig->setValid(true);
        $this->jPushGroupConfigs[$groupKey] = $groupConfig;

        return $groupConfig;
    }
}
