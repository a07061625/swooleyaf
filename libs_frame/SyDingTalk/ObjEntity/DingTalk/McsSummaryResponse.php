<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果对象
 *
 * @author auto create
 */
class McsSummaryResponse
{
    /**
     * 视频会议企业的累积消耗时长（即参会者入会总时长，且算到发起企业上）(毫秒)
     */
    public $join_video_conf_len;

    /**
     * 视频会议企业的累积消耗时长（即参会者入会总时长，且算到发起企业上）(分钟)
     */
    public $join_video_conf_len_min;

    /**
     * 视频会议成功参与人次
     */
    public $join_video_conf_secc_usr_cnt;

    /**
     * 视频会议成功参与用户数
     */
    public $join_video_conf_secc_usr_num;

    /**
     * 参与视频会议用户数
     */
    public $join_video_conf_usr_cnt;

    /**
     * 视频会议发起次数
     */
    public $start_video_conf_cnt;

    /**
     * 成功发起视频会议时长（分钟）
     */
    public $start_video_conf_len_min;

    /**
     * 成功发起视频会议数
     */
    public $start_video_conf_secc_cnt;

    /**
     * 视频会议发起用户数
     */
    public $start_video_conf_usr_num;

    /**
     * 视频会议平均每通参与人次
     */
    public $video_conf_ave_usr_num;
}
