<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class OapiCreateBlackboardVo
{
    /**
     * 公告作者
     */
    public $author;

    /**
     * 入参
     */
    public $blackboard_receiver;

    /**
     * 公告分类id，可以通过公告开放接口：（获取企业公告未删除分类列表）获取有效值
     */
    public $category_id;

    /**
     * 公告内容
     */
    public $content;

    /**
     * 封面图,需要使用mediaId,可以通过钉钉开放接口：https://ding-doc.dingtalk.com/doc#/serverapi2/bcmg0i 上传图片获取mediaId
     */
    public $coverpic_mediaid;

    /**
     * 是否发送应用内钉提醒
     */
    public $ding;

    /**
     * 操作人的userId(必须是公告管理员)
     */
    public $operation_userid;

    /**
     * 保密等级，仅支持以下值(0:普通公告，20：保密公告)
     */
    public $private_level;

    /**
     * 公告是否置顶
     */
    public $push_top;

    /**
     * 公告标题
     */
    public $title;
}
