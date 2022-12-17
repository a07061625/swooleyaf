<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 知识页列表
 *
 * @author auto create
 */
class OpenDocVO
{
    /**
     * 知识库ID（加密后的）
     */
    public $group_id;

    /**
     * 知识页ID（加密后的）
     */
    public $id;

    /**
     * 文档最近一次cp的url
     */
    public $latest_cp_url;

    /**
     * 知识页的名字
     */
    public $name;

    /**
     * 知识页所在知识本id（加密后的值）
     */
    public $repo_id;

    /**
     * 文档分享链接的url
     */
    public $share_url;
}
