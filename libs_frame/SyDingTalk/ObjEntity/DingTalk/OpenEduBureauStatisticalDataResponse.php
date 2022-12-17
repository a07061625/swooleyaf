<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果
 *
 * @author auto create
 */
class OpenEduBureauStatisticalDataResponse
{
    /**
     * 最近1天活跃班级圈数
     */
    public $act_class_circle_cnt1d;

    /**
     * 最近7天活跃班级圈数
     */
    public $act_class_circle_cnt7d;

    /**
     * 最近1天活跃班级群数
     */
    public $act_class_group_cnt1d;

    /**
     * 最近7天活跃班级群数
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
     * 注册班级数
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
     * 局id
     */
    public $corp_id;

    /**
     * 注册家长数
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
     * 注册学校数
     */
    public $school_cnt_std;

    /**
     * 最近1天班级圈发送数
     */
    public $send_circle_post_cnt1d;

    /**
     * 最近7天班级圈发送数
     */
    public $send_circle_post_cnt7d;

    /**
     * 统计日期
     */
    public $stat_date;

    /**
     * 注册学生数
     */
    public $student_cnt_std;

    /**
     * 注册教师数
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
}
