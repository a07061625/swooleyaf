<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 职位信息列表
 *
 * @author auto create
 */
class TopBizFlowStatisticsVo
{
    /**
     * 候选人id
     */
    public $candidate_id;

    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 创建人userid
     */
    public $creator_userid;

    /**
     * 应聘流程id
     */
    public $flow_id;

    /**
     * 应聘状态  11：待初筛  12：初筛通过 13：初筛不通过  21： 应聘流程中  22：应聘通过  23：应聘不通过(不录用)  31： offer流程中  32： offer通过(录用)  33：offer失败  34： offer取消(取消录用)  41：待入职  42：已入职
     */
    public $flow_status;

    /**
     * 创建时间，unix时间戳，单位毫秒
     */
    public $gmt_create_mils;

    /**
     * 更新时间，unix时间戳，单位毫秒
     */
    public $gmt_modified_mils;

    /**
     * 职位id
     */
    public $job_id;

    /**
     * 负责人userid
     */
    public $owner_userid;

    /**
     * 应聘id
     */
    public $recruit_id;

    /**
     * 简历id
     */
    public $resume_id;
}
