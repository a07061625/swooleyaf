<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 职位信息列表
 *
 * @author auto create
 */
class TopJobStatisticsVo
{
    /**
     * 招聘业务标识
     */
    public $biz_code;

    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 职位创建人id
     */
    public $creator_userid;

    /**
     * 创建时间，unix时间戳，单位毫秒
     */
    public $gmt_create_mils;

    /**
     * 更新时间，unix时间戳，单位毫秒
     */
    public $gmt_modified_mils;

    /**
     * 招聘人数
     */
    public $head_count;

    /**
     * 职位id
     */
    public $job_id;

    /**
     * 职位归属部门id
     */
    public $main_dept_id;

    /**
     * 职位名称
     */
    public $name;

    /**
     * 职位负责人id
     */
    public $owner_userid;

    /**
     * 0：新创建  1：已发布  2：废弃  3：招满
     */
    public $status;
}
