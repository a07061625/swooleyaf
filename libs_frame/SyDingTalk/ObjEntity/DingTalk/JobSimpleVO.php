<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 职位结果
 *
 * @author auto create
 */
class JobSimpleVO
{
    /**
     * 职位地址详情
     */
    public $address;

    /**
     * true :校招，false：社招
     */
    public $campus;

    /**
     * 职位分类
     */
    public $category;

    /**
     * 职位地址 市
     */
    public $city;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 职位描述
     */
    public $description;

    /**
     * 职位地址 区/县
     */
    public $district;

    /**
     * 招募人数
     */
    public $head_count;

    /**
     * 职位编码
     */
    public $job_code;

    /**
     * 职位唯一标识
     */
    public $job_id;

    /**
     * 职位类型：FULL-TIME:全职，PART-TIME:兼职，INTERNSHIP:实习，OTHER:其他
     */
    public $job_nature;

    /**
     * 职位部门id
     */
    public $main_dept_id;

    /**
     * 最高工作年限
     */
    public $max_job_experience;

    /**
     * 最高薪水，单位元
     */
    public $max_salary;

    /**
     * 最低工作年限
     */
    public $min_job_experience;

    /**
     * 最低薪水，单位元
     */
    public $min_salary;

    /**
     * 职位名称
     */
    public $name;

    /**
     * 兼职字段
     */
    public $part_time_data;

    /**
     * 职位地址 升
     */
    public $province;

    /**
     * 1小学 2初中 3高中 4中专 5大专 6本科 7硕士 8 博士 9其他
     */
    public $required_edu;

    /**
     * 薪资月数
     */
    public $salary_month;

    /**
     * 是否薪资面议
     */
    public $salary_negotiable;

    /**
     * 薪资类型，HOUR:小时，DAY:天，WEEK:周，MONTH:月，BY_TIME:次
     */
    public $salary_period;

    /**
     * 职位标签
     */
    public $tags;
}
