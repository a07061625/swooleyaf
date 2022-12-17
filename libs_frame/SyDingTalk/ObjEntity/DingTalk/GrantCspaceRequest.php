<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * request
 *
 * @author auto create
 */
class GrantCspaceRequest
{
    /**
     * 应用id
     */
    public $agentid;

    /**
     * 附件id
     */
    public $file_id;

    /**
     * 附件id列表，支持批量授权
     */
    public $fileid_list;

    /**
     * 实例id
     */
    public $process_instance_id;

    /**
     * 授权用户id
     */
    public $userid;
}
