<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果对象
 *
 * @author auto create
 */
class OpenAccountRs
{
    /**
     * 账期结束时间
     */
    public $end_date;

    /**
     * 账期开始时间
     */
    public $start_date;

    /**
     * json数据下载链接，通过HttpClient 获取 并GBK格式解析，链接五分钟有效期
     */
    public $url;
}
