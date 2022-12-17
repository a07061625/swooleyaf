<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 答题记录详情
 *
 * @author auto create
 */
class StudentAnswerDetail
{
    /**
     * 学生答题时间戳
     */
    public $answer_time;

    /**
     * 扩展属性
     */
    public $attributes;

    /**
     * 业务编码
     */
    public $biz_code;

    /**
     * 班级ID
     */
    public $class_id;

    /**
     * 作业ID
     */
    public $hw_id;

    /**
     * 是否答对
     */
    public $is_right;

    /**
     * 题目ID
     */
    public $question_id;

    /**
     * 做了多少次
     */
    public $redo_times;

    /**
     * 做题时间
     */
    public $spend_time;

    /**
     * 学生提交的答案
     */
    public $student_answer;

    /**
     * 学生ID
     */
    public $student_id;

    /**
     * 学生姓名
     */
    public $student_name;
}
