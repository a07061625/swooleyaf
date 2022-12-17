<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回数据
 *
 * @author auto create
 */
class CardTaskDTO
{
    /**
     * 卡片id
     */
    public $card_id;

    /**
     * 班级名称
     */
    public $class_name;

    /**
     * 打卡内容
     */
    public $content;

    /**
     * 打卡日期
     */
    public $date;

    /**
     * 是否完成打卡 N当日未完成打卡  Y完成打卡
     */
    public $is_finish_task;

    /**
     * 学生名字
     */
    public $student_name;

    /**
     * 打卡任务名字
     */
    public $title;

    /**
     * 任务id
     */
    public $user_card_task_id;
}
