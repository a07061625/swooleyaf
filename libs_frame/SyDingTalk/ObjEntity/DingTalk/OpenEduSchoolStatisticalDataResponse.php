<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果集
 *
 * @author auto create
 */
class OpenEduSchoolStatisticalDataResponse
{
    /**
     * 最近1天活跃的班级圈数
     */
    public $act_class_circle_cnt1d;

    /**
     * 最近7天活跃的班级圈数
     */
    public $act_class_circle_cnt7d;

    /**
     * 最近1天活跃的班级群数
     */
    public $act_class_group_cnt1d;

    /**
     * 最近7天活跃的班级群数
     */
    public $act_class_group_cnt7d;

    /**
     * 最近1天活跃家长数量
     */
    public $act_patriarch_cnt1d;

    /**
     * 最近7天活跃家长数量
     */
    public $act_patriarch_cnt7d;

    /**
     * 最近1天活跃教师数量
     */
    public $act_teacher_cnt1d;

    /**
     * 最近7天活跃教师数量
     */
    public $act_teacher_cnt7d;

    /**
     * 最近1天活跃用户数
     */
    public $act_usr_cnt1d;

    /**
     * 最近7天总活跃用户数
     */
    public $act_usr_cnt7d;

    /**
     * 最近1天活跃率
     */
    public $act_usr_ratio1d;

    /**
     * 最近7天活跃率
     */
    public $act_usr_ratio7d;

    /**
     * 激活用户数
     */
    public $active_mbr_cnt_std;

    /**
     * 数字化教师数量
     */
    public $auth_teacher_cnt_std;

    /**
     * 最近1天班级打卡使用人数
     */
    public $class_card_user_cnt1d;

    /**
     * 最近7天班级打卡使用人数
     */
    public $class_card_user_cnt7d;

    /**
     * 最近1天班级圈使用人数
     */
    public $class_circle_user_cnt1d;

    /**
     * 最近7天班级圈使用人数
     */
    public $class_circle_user_cnt7d;

    /**
     * 班级数量
     */
    public $class_cnt_std;

    /**
     * 最近1天班级群使用人数
     */
    public $class_group_user_cnt1d;

    /**
     * 最近7天班级群使用人数
     */
    public $class_group_user_cnt7d;

    /**
     * 教育局ID
     */
    public $corp_id;

    /**
     * 最近1天钉钉指数
     */
    public $ding_index1d;

    /**
     * 最近7天钉钉指数
     */
    public $ding_index7d;

    /**
     * 最近1天成功发起直播次数
     */
    public $live_launch_succ_cnt1d;

    /**
     * 最近7天成功发起直播次数
     */
    public $live_launch_succ_cnt7d;

    /**
     * 最近1天观看和回看直播人数
     */
    public $live_play_user_cnt1d;

    /**
     * 最近7天观看和回看直播人数
     */
    public $live_play_user_cnt7d;

    /**
     * 最近1天成功发起直播时长
     */
    public $live_succ_time_len1d;

    /**
     * 最近7天成功发起直播时长
     */
    public $live_succ_time_len7d;

    /**
     * 激活率
     */
    public $mbr_active_ratio;

    /**
     * 通讯录人数
     */
    public $mbr_cnt_std;

    /**
     * 多家长监管学生数
     */
    public $multi_patriarch_student_cnt;

    /**
     * 多家长监管学生比率
     */
    public $multi_patriarch_student_ratio;

    /**
     * 无家长监管学生数
     */
    public $none_patriarch_student_cnt;

    /**
     * 无家长监管学生比率
     */
    public $none_patriarch_student_ratio;

    /**
     * 家长数量
     */
    public $patriarch_cnt_std;

    /**
     * 最近1天接收DING的家长数
     */
    public $rcv_ding_patriarch_cnt1d;

    /**
     * 最近7天接收DING的家长数
     */
    public $rcv_ding_patriarch_cnt7d;

    /**
     * 最近1天班级圈发送数
     */
    public $send_circle_post_cnt1d;

    /**
     * 最近7天班级圈发送数
     */
    public $send_circle_post_cnt7d;

    /**
     * 最近1天沟通用户数
     */
    public $send_msg_user_cnt1d;

    /**
     * 最近7天沟通用户数
     */
    public $send_msg_user_cnt7d;

    /**
     * 最近1天沟通率
     */
    public $send_msg_user_ratio1d;

    /**
     * 最近7天沟通率
     */
    public $send_msg_user_ratio7d;

    /**
     * 单家长监管学生数
     */
    public $single_patriarch_student_cnt;

    /**
     * 单家长监管学生比率
     */
    public $single_patriarch_student_ratio;

    /**
     * 统计日期
     */
    public $stat_date;

    /**
     * 学生数量
     */
    public $student_cnt_std;

    /**
     * 所辖组织的地理纬度
     */
    public $sub_corp_area_lat;

    /**
     * 所辖组织的地理经度
     */
    public $sub_corp_area_lng;

    /**
     * 学校id
     */
    public $sub_corp_id;

    /**
     * 学校名称
     */
    public $sub_corp_name;

    /**
     * 教师数量
     */
    public $teacher_cnt_std;

    /**
     * 最近1天教师钉消息发送数
     */
    public $teacher_send_ding_cnt1d;

    /**
     * 最近7天教师钉消息发送数
     */
    public $teacher_send_ding_cnt7d;

    /**
     * 双家长监管学生数
     */
    public $two_patriarch_student_cnt;

    /**
     * 双家长监管学生比率
     */
    public $two_patriarch_student_ratio;
}
