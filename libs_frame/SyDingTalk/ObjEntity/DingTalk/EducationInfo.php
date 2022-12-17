<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 教育经历
 *
 * @author auto create
 */
class EducationInfo
{
    /**
     * 学位
     */
    public $advanced_degree;

    /**
     * 院系
     */
    public $department;

    /**
     * 学历
     */
    public $education;

    /**
     * 终止时间
     */
    public $end_date;

    /**
     * 其它内容
     */
    public $others;

    /**
     * 学校名称
     */
    public $school;

    /**
     * 学校特征标签
     */
    public $school_label;

    /**
     * 院校类别：取值为 0：普通，1：211 院校，2：985 院校，3：既是 211 又是 985 院校，4：外国 5：台湾大学
     */
    public $school_type;

    /**
     * 专业
     */
    public $speciality;

    /**
     * 开始时间
     */
    public $start_date;

    /**
     * 统招或自考
     */
    public $student_type;

    /**
     * 留学经历
     */
    public $study_abroad_experience;

    /**
     * 详细介绍
     */
    public $summary;
}
