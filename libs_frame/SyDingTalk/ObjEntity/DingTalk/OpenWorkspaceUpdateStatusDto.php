<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 更新状态
 *
 * @author auto create
 */
class OpenWorkspaceUpdateStatusDto
{
    /**
     * 对于项目有如下状态： WORKING进行中 DISBANDED解散 CLOSE归档 RECYCLE回收站状态 新建项目后状态是WORKING，WORKING/CLOSE/RECYCLE回收站状态可以切换，但是一旦成为DISBANDED则说明项目已销毁无法变更状态
     */
    public $status;
}
