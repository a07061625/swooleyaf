<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 参数
 *
 * @author auto create
 */
class OpenCardTaskSubmitParam
{
    /**
     * 班级ID
     */
    public $card_biz_id;

    /**
     * 业务类型
     */
    public $card_bizcode;

    /**
     * 卡片ID cardId
     */
    public $card_id;

    /**
     * 任务Code
     */
    public $card_task_code;

    /**
     * 当前人的任务ID
     */
    public $card_task_id;

    /**
     * 打卡的内容
     */
    public $content;

    /**
     * 详情的URL
     */
    public $detail_url;

    /**
     * 编辑的URL
     */
    public $edit_url;

    /**
     * 用户打卡传入的音视频类型
     */
    public $medias;

    /**
     * 计数
     */
    public $metering_number;

    /**
     * 当前是否为补卡
     */
    public $reissue_card;

    /**
     * 结果评定文案
     */
    public $result_evaluation;

    /**
     * 内容来源,需申请
     */
    public $source_type;

    /**
     * 单位
     */
    public $unit_of_measurement;

    /**
     * 当前人的staffId
     */
    public $userid;
}
