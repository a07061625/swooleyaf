<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class OapiBlackboardQueryVo
{
    /**
     * 分类id，可以通过https://oapi.dingtalk.com/blackboard/category/get获取有效值
     */
    public $category_id;

    /**
     * 结束时间(开区间）
     */
    public $end_time;

    /**
     * 操作人userId(必须是公告管理员)
     */
    public $operation_userid;

    /**
     * 页码，从1开始且必须为正整数
     */
    public $page;

    /**
     * 分页大小，必须为正整数，且不超过30
     */
    public $page_size;

    /**
     * 开始时间(闭区间）
     */
    public $start_time;
}
