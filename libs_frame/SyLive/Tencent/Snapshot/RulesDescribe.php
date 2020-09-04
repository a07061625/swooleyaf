<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 16:51
 */
namespace SyLive\Tencent\Snapshot;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyLive\BaseTencent;

/**
 * 获取截图规则列表
 *
 * @package SyLive\Tencent\Snapshot
 */
class RulesDescribe extends BaseTencent
{
    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveSnapshotRules';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
