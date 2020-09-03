<?php
/**
 * 获取跑马灯设置
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;

/**
 * Class LiveHorseLampGet
 * @package SyLive\BaiJia\SettingLive
 */
class LiveHorseLampGet extends BaseBaiJiaSetting
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/getLiveHorseLamp';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
