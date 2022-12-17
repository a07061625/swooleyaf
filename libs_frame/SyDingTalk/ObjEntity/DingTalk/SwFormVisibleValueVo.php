<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 可识别是否加密的可见范围
 *
 * @author auto create
 */
class SwFormVisibleValueVo
{
    /**
     * cid是否加密
     */
    public $cid_encrypted;

    /**
     * 0部门 1人员 3 群
     */
    public $visible_type;

    /**
     * 可见范围的值
     */
    public $visible_value;
}
