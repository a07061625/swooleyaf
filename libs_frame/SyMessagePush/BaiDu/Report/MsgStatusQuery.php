<?php
/**
 * 查询消息的发送状态
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:57
 */
namespace SyMessagePush\BaiDu\Report;

use SyMessagePush\PushBaseBaiDu;

class MsgStatusQuery extends PushBaseBaiDu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/report/query_msg_status';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
