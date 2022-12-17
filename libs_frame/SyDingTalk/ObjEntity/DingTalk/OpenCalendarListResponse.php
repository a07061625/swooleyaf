<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * api返回的结果对象
 *
 * @author auto create
 */
class OpenCalendarListResponse
{
    /**
     * 日程的实体
     */
    public $items;

    /**
     * 请求结果若还有更多，则返回下一页的token值
     */
    public $next_page_token;

    /**
     * 文件夹描述
     */
    public $summary;
}
