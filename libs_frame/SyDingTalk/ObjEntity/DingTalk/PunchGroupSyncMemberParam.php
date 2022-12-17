<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 同步参数
 *
 * @author auto create
 */
class PunchGroupSyncMemberParam
{
    /**
     * 新增成员列表
     */
    public $add_member_list;

    /**
     * 业务唯一标识
     */
    public $biz_id;

    /**
     * 业务实例唯一标识
     */
    public $biz_inst_id;

    /**
     * 删除成员列表
     */
    public $delete_member_list;

    /**
     * 打卡组唯一标识
     */
    public $punch_group_id;
}
