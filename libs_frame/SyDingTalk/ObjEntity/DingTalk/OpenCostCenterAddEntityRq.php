<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenCostCenterAddEntityRq
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 人员信息列表
     */
    public $entity_list;

    /**
     * 第三方成本中心id
     */
    public $thirdpart_id;
}
