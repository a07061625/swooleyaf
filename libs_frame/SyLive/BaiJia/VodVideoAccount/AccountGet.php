<?php
/**
 * 获取账号套餐使用量
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace SyLive\BaiJia\VodVideoAccount;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;

/**
 * Class AccountGet
 * @package SyLive\BaiJia\VodVideoAccount
 */
class AccountGet extends BaseBaiJia
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_account/getAccountInfo';
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
