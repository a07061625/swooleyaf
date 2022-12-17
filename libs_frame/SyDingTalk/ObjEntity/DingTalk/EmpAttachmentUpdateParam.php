<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 更新信息
 *
 * @author auto create
 */
class EmpAttachmentUpdateParam
{
    /**
     * 字段ID
     */
    public $field_code;

    /**
     * 文件名后缀，用以标识和展示
     */
    public $file_suffix;

    /**
     * 文件id，参考oapi.dingtalk.com/media/upload接口
     */
    public $media_id;

    /**
     * 用户ID
     */
    public $userid;
}
