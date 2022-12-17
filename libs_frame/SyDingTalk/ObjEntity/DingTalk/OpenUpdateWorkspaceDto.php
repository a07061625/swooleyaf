<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 修改项目/圈子信息
 *
 * @author auto create
 */
class OpenUpdateWorkspaceDto
{
    /**
     * 非必填。描述，长度256字符以内
     */
    public $desc;

    /**
     * 非必填。mediaId格式，参考https://ding-doc.dingtalk.com/doc#/serverapi2/bcmg0i
     */
    public $logo_media_id;

    /**
     * 非必填必填。组织名，长度3-50个字符以内，不允许中划线、下划线、逗号、空格
     */
    public $name;

    /**
     * 非必填。修改项目负责人，传新负责人在项目组织内的userId（注意不是归属组织的）
     */
    public $owner_userid;
}
