<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 打卡动态修改入参
 *
 * @author auto create
 */
class OpenUpdatePostParam
{
    /**
     * 业务类型
     */
    public $card_biz_code;

    /**
     * 班级ID
     */
    public $card_biz_id;

    /**
     * 卡片ID
     */
    public $card_id;

    /**
     * 提交的文本内容
     */
    public $content;

    /**
     * 详情的RUL
     */
    public $detail_url;

    /**
     * 编辑的URL
     */
    public $edit_url;

    /**
     * 提交的多媒体信息
     */
    public $medias;

    /**
     * 打卡：计量数
     */
    public $metering_number;

    /**
     * 动态ID
     */
    public $post_id;

    /**
     * 打卡：补卡标示
     */
    public $reissue_card;

    /**
     * 打卡：展示名称
     */
    public $show_name;

    /**
     * 内容来源
     */
    public $source_type;

    /**
     * 打卡：单位
     */
    public $unit_of_measurement;

    /**
     * 当前登录用户的staffId
     */
    public $userid;
}
