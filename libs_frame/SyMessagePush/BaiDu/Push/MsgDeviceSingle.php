<?php
/**
 * 推送消息到单台设备
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:53
 */
namespace SyMessagePush\BaiDu\Push;

use SyMessagePush\PushBaseBaiDu;

class MsgDeviceSingle extends PushBaseBaiDu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/push/single_device';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
