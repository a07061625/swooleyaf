<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果对象
 *
 * @author auto create
 */
class AnnualReportResponse
{
    /**
     * 年累计活跃天数
     */
    public $act_usr_days1y;

    /**
     * 年累计打卡天数
     */
    public $at_check_days1y;

    /**
     * 年累计被at数
     */
    public $at_me_msg_cnt1y;

    /**
     * 年累计审批平均处理时间（分钟）
     */
    public $avg_process_duration1y;

    /**
     * 年累计企业自建应用发起的审批数
     */
    public $corp_app_process_inst_cnt1y;

    /**
     * 年累计创建文档数
     */
    public $create_doc_cnt1y;

    /**
     * 年累计创建审批数
     */
    public $create_process_cnt1y;

    /**
     * 年累计创建智能填表数
     */
    public $create_smartwork_cnt1y;

    /**
     * 年累计智能填表的人次，仅当type=1时有效
     */
    public $general_form_user_cnt1y;

    /**
     * 年累计新增内部群聊数量，仅当type=3时有效
     */
    public $inner_group_cnt1y;

    /**
     * 年累计阅读互动服务窗文章数量
     */
    public $isw_msg_click_cnt1y;

    /**
     * 年累计参加日程数
     */
    public $join_calendar_cnt1y;

    /**
     * 年累计参加日程人数
     */
    public $join_calendar_user_cnt1y;

    /**
     * 年累计加入群数
     */
    public $join_group_cnt1y;

    /**
     * 年累计发起视频会议时长（分钟）
     */
    public $join_succ_video_conf_len1y;

    /**
     * 年累计参与（含发起）视频会议次数
     */
    public $join_succ_video_conf_num1y;

    /**
     * 年累计参与（含发起）视频会议人次，仅当type=1时有效
     */
    public $join_succ_video_conf_user_cnt1y;

    /**
     * 年累计参与（含发起）语音会议时长（分钟）
     */
    public $join_succ_voip_conf_len1y;

    /**
     * 年累计参与（含发起）语音会议次数
     */
    public $join_succ_voip_conf_num1y;

    /**
     * 年累计参与（含发起）语音会议人次，仅当type=1时有效
     */
    public $join_succ_voip_conf_user_cnt1y;

    /**
     * 年累计参与直播次数
     */
    public $live_join_succ_cnt1y;

    /**
     * 年累计参与直播时长（分钟）
     */
    public $live_join_succ_time_len1y;

    /**
     * 年累计最高运动步数
     */
    public $max_step_count1y;

    /**
     * 年累计审批最短处理时间（分钟）
     */
    public $min_process_duration1y;

    /**
     * 年累计新增群数
     */
    public $new_group_cnt1y;

    /**
     * 年累计外勤天数
     */
    public $outside_days1y;

    /**
     * 处理审批数
     */
    public $process_inst_operate_cnt1y;

    /**
     * 发起审批数
     */
    public $process_inst_submit_cnt1y;

    /**
     * 年累计接收DING数
     */
    public $recv_ding_cnt1y;

    /**
     * 年累计新建日程数
     */
    public $send_calendar_cnt1y;

    /**
     * 年累计新建日程人数
     */
    public $send_calendar_user_cnt1y;

    /**
     * 年累计发送DING数
     */
    public $send_ding_cnt1y;

    /**
     * 年累计发送DING人数
     */
    public $send_ding_user_cnt1y;

    /**
     * 年累计发送群文件数
     */
    public $send_group_file_message_cnt1y;

    /**
     * 年累计发送群聊消息数
     */
    public $send_group_msg_cnt1y;

    /**
     * 年累计发送群聊人数
     */
    public $send_group_msg_user_cnt1y;

    /**
     * 年累计活跃群数（发消息群）
     */
    public $send_message_group_cnt1y;

    /**
     * 年累计发送日志数
     */
    public $send_report_cnt1y;

    /**
     * 年累计发送日志人数
     */
    public $send_report_user_cnt1y;

    /**
     * 发起视频会议时长（分钟）
     */
    public $start_succ_video_conf_len1y;

    /**
     * 使用文档用户数（创建、编辑、分享、阅读）
     */
    public $use_doc_user_cnt1y;

    /**
     * 年累计使用的应用数量
     */
    public $use_micro_app_cnt1y;

    /**
     * 年累计使用的应用人数，仅当type=1,2时有效
     */
    public $use_micro_user_cnt1y;

    /**
     * 年累计参与智能填表数
     */
    public $use_smartwork_cnt1y;
}
