<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 17:36
 */
namespace SyLive\Tencent\Callback;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyLive\BaseTencent;

/**
 * 获取回调规则列表
 *
 * @package SyLive\Tencent\Callback
 */
class RulesDescribe extends BaseTencent
{
    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveCallbackRules';
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
