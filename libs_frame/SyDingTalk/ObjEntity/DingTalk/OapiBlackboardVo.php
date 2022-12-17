<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 出参，success为true时，该值不为空，否则值为空
 *
 * @author auto create
 */
class OapiBlackboardVo
{
    /**
     * 公告作者
     */
    public $author;

    /**
     * 公告分类
     */
    public $category_id;

    /**
     * 公告内容
     */
    public $content;

    /**
     * 封面图的url链接
     */
    public $coverpic_url;

    /**
     * 接收部门列表
     */
    public $depname_list;

    /**
     * 接收部门列表
     */
    public $dept_list;

    /**
     * 公告创建时间
     */
    public $gmt_create;

    /**
     * 公告最后修改时间
     */
    public $gmt_modified;

    /**
     * 公告id
     */
    public $id;

    /**
     * 保密等级(0：普通公告，20：保密公告)
     */
    public $private_level;

    /**
     * 已读人数
     */
    public $read_count;

    /**
     * 公告标题
     */
    public $title;

    /**
     * 未读人数
     */
    public $unread_count;

    /**
     * 接收人列表
     */
    public $user_list;

    /**
     * 接收人列表
     */
    public $username_list;
}
