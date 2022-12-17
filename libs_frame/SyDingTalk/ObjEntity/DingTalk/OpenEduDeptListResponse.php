<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 数据集，不为空。
 *
 * @author auto create
 */
class OpenEduDeptListResponse
{
    /**
     * 部门节点列表，不空。
     */
    public $details;

    /**
     * 是否有更多数据
     */
    public $has_more;

    /**
     * 父部门id
     */
    public $super_id;
}
