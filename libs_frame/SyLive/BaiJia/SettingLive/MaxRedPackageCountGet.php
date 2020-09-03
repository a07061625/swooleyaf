<?php
/**
 * 获取红包最大个数限制
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;

/**
 * Class MaxRedPackageCountGet
 * @package SyLive\BaiJia\SettingLive
 */
class MaxRedPackageCountGet extends BaseBaiJiaSetting
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/getMaxRedPackageCount';
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
