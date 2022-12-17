<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class EmpRosterFieldVo
{
    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 字段信息列表
     */
    public $field_data_list;

    /**
     * 根据企业ID和钉钉用户ID生成的唯一ID
     */
    public $unionid;

    /**
     * 员工id
     */
    public $userid;
}
