<?php
/**
 * 查询转码回调地址(点播和回放)
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace SyLive\BaiJia\VodVideoAccount;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;

/**
 * Class TransCodeCallbackUrlGet
 * @package SyLive\BaiJia\VodVideoAccount
 */
class TransCodeCallbackUrlGet extends BaseBaiJia
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_account/getTranscodeCallbackUrl';
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
