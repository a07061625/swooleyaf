<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class Req
{
    /**
     * 开始时间(单位：秒)。空表示不限，左闭右开。PS：当前只保留了7天的记录
     */
    public $begin_time;

    /**
     * 此次查询成功后，是否立即将状态改为“已确认”。传空取默认值false
     */
    public $confirm;

    /**
     * 分页查询，上次查询结果中的最后一个id
     */
    public $cursor;

    /**
     * 结束时间(单位：秒)。空表示不限，左闭右开
     */
    public $end_time;

    /**
     * 分页大小，最大支持100
     */
    public $page_size;

    /**
     * 确认状态，0-已确认 1-未确认，不填表示不区分
     */
    public $status;

    /**
     * 回调事件类型
     */
    public $tags;
}
