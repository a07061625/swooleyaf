<?php
/**
 * 获取水印配置
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;

/**
 * Class WatermarkGet
 * @package SyLive\BaiJia\SettingLive
 */
class WatermarkGet extends BaseBaiJiaSetting
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/getWatermark';
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
