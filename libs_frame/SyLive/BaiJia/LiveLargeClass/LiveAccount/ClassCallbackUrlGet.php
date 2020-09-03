<?php
/**
 * 查询直播上下课回调地址
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:50
 */
namespace SyLive\BaiJia\LiveLargeClass\LiveAccount;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;

/**
 * Class ClassCallbackUrlGet
 * @package SyLive\BaiJia\LiveLargeClass\LiveAccount
 */
class ClassCallbackUrlGet extends BaseBaiJia
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_account/getClassCallbackUrl';
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
