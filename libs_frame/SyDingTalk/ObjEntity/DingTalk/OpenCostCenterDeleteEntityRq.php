<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenCostCenterDeleteEntityRq
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 是否全部删除
     */
    public $del_all;

    /**
     * 删除的成员信息列表,del_all为true时可不填
     */
    public $entity_list;

    /**
     * 第三方成本中心id
     */
    public $thirdpart_id;
}
