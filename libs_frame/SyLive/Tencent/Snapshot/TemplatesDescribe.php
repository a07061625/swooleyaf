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
 * 获取截图模板列表
 *
 * @package SyLive\Tencent\Snapshot
 */
class TemplatesDescribe extends BaseTencent
{
    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveSnapshotTemplates';
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
