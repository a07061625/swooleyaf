<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class OapiUpdateBlackboardVo
{
    /**
     * 公告作者
     */
    public $author;

    /**
     * 公告id
     */
    public $blackboard_id;

    /**
     * 公告分类id，可以通过https://oapi.dingtalk.com/blackboard/category/get获取有效值
     */
    public $category_id;

    /**
     * 公告内容
     */
    public $content;

    /**
     * 封面图,需要使用mediaId,可以通过https://oapi.dingtalk.com/media/upload上传图片获取mediaId
     */
    public $coverpic_mediaid;

    /**
     * 是否发送应用内钉提醒
     */
    public $ding;

    /**
     * 修改后是否再次通知接收人
     */
    public $notify;

    /**
     * 操作人userId(必须是公告管理员)
     */
    public $operation_userid;

    /**
     * 公告标题
     */
    public $title;
}
