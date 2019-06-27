<?php
/**
 * 查询分类主题列表
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:04
 */
namespace SyMessagePush\BaiDu\Topic;

use SyMessagePush\PushBaseBaiDu;

class TopicList extends PushBaseBaiDu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/topic/query_list';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
