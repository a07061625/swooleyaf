<?php
/**
 * 查询定时任务列表
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:02
 */
namespace SyMessagePush\BaiDu\Timer;

use SyMessagePush\PushBaseBaiDu;

class TimerList extends PushBaseBaiDu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/timer/query_list';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
