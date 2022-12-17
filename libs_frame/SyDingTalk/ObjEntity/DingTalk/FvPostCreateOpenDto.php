<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 创建动态的入参
 *
 * @author auto create
 */
class FvPostCreateOpenDto
{
    /**
     * 动态的内容
     */
    public $content;

    /**
     * 动态所属标签或话题
     */
    public $tags;

    /**
     * 用户在圈子或项目内的userId
     */
    public $userid;

    /**
     * 请求的唯一标识，防止同一请求多次访问。若重复会返回错误:需要uuid
     */
    public $uuid;
}
