<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 附件内容
 *
 * @author auto create
 */
class AttachmentVO
{
    /**
     * 文件后缀, 用于展示文件对应图标
     */
    public $detail_type;

    /**
     * 上传DING盘后的文件ID
     */
    public $file_id;

    /**
     * 文件名
     */
    public $file_name;

    /**
     * 文件大小(单位:Byte, 最大2G)
     */
    public $file_size;

    /**
     * 上传DING盘后的SpaceId
     */
    public $file_space_id;

    /**
     * 链接缩略图
     */
    public $link_pic_url;

    /**
     * 链接摘要
     */
    public $link_text;

    /**
     * 链接标题
     */
    public $link_title;

    /**
     * 链接URL
     */
    public $link_url;

    /**
     * 附件类型:img-图片,link-链接,file-文件
     */
    public $type;
}
