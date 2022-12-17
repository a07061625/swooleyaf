<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenCostCenterQueryRq
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 是否需要展示成员信息，当成本中心为部分人员适用的时候有返回
     */
    public $need_org_entity;

    /**
     * 第三方成本中心id，不填写的时候user_id必填
     */
    public $thirdpart_id;

    /**
     * 成本中心名称
     */
    public $title;

    /**
     * 用户id，不填的时候thirdpart_id必填
     */
    public $userid;
}
