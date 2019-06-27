<?php
/**
 * 查询标签组列表
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:00
 */
namespace SyMessagePush\BaiDu\Tag;

use SyMessagePush\PushBaseBaiDu;

class TagList extends PushBaseBaiDu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/app/query_tags';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
