<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 服务调用结果对象
 *
 * @author auto create
 */
class ConferenceInfoDo
{
    /**
     * 会务地点
     */
    public $address;

    /**
     * 会务管理员userid
     */
    public $admin_userid;

    /**
     * 会务筹备者userid列表
     */
    public $arrange_userid_list;

    /**
     * 会务Id
     */
    public $conference_id;

    /**
     * 会务简介
     */
    public $content;

    /**
     * 举办会务的企业Id
     */
    public $corp_id;

    /**
     * 会务创建者userid
     */
    public $create_userid;

    /**
     * 会务结束时间，时间戳格式，单位为毫秒
     */
    public $end_time;

    /**
     * 最近更新会务信息的userid
     */
    public $modified_userid;

    /**
     * 高德经纬度，格式:longitude,latitude
     */
    public $poi;

    /**
     * 会务开始时间，时间戳格式，单位为毫秒
     */
    public $start_time;

    /**
     * 会务状态，2 - 筹备中，3 - 已发布，10 - 已结束
     */
    public $status;

    /**
     * 会务主题
     */
    public $topic;

    /**
     * 会务主题图片地址
     */
    public $topic_pic_url;

    /**
     * 会务类型，1 - 年会，2 - 沙龙
     */
    public $type;

    /**
     * 会务信息版本号，信息更新时进行递增
     */
    public $version;
}
