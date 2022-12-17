<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class SuggestRq
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 搜索关键字
     */
    public $keyword;

    /**
     * 0国内机场，2国内机场+临近机场，3国际机场
     */
    public $type;

    /**
     * 用户id
     */
    public $userid;
}
