<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 候选人信息
 *
 * @author auto create
 */
class TopCandidateVO
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
     * 创建时间，unix毫秒时间戳
     */
    public $gmt_create_mils;

    /**
     * 修改时间，unix毫秒时间戳
     */
    public $gmt_modified_mils;

    /**
     * 候选人姓名
     */
    public $name;
}
