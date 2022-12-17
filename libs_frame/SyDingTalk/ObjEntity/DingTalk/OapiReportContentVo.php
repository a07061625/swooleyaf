<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 保存日志内容对应的模板某个字段的唯一序列id
 *
 * @author auto create
 */
class OapiReportContentVo
{
    /**
     * 日志内容
     */
    public $content;

    /**
     * 日志内容的类型
     */
    public $content_type;

    /**
     * 写日志对应的模板某个字段的标题
     */
    public $key;

    /**
     * 写日志对应的模板某个字段的唯一序列id
     */
    public $sort;

    /**
     * 写日志对应的模板某个字段的类型
     */
    public $type;
}
