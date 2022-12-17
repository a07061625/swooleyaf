<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 职位列表，单次最多20个
 *
 * @author auto create
 */
class AtsAddJobParam
{
    /**
     * 工作地点
     */
    public $address;

    /**
     * 是否校招
     */
    public $campus;

    /**
     * 城市编码
     */
    public $city;

    /**
     * 操作人员工标识
     */
    public $creator_user_id;

    /**
     * 职位描述
     */
    public $description;

    /**
     * 区县编码
     */
    public $district;

    /**
     * 扩展数据
     */
    public $ext_data;

    /**
     * 职位性质，FULL-TIME：全职，PART-TIME：兼职，INTERNSHIP：实习，OTHER：其他
     */
    public $job_nature;

    /**
     * 最低月薪，单位：元
     */
    public $max_salary;

    /**
     * 最高月薪，单位：元
     */
    public $min_salary;

    /**
     * 职位名称
     */
    public $name;

    /**
     * 职位负责人的员工标识列表
     */
    public $owner_user_ids;

    /**
     * 省域编码
     */
    public $province;

    /**
     * 学历要求，1小学 2初中 3高中  4中专 5大专 6本科  7硕士 8 博士 9其他
     */
    public $required_edu;
}
