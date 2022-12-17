<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class HomePageReportTemplateVo
{
    /**
     * 下一次分页调用的offset值，当返回结果里没有nextCursor时，表示分页结束
     */
    public $next_cursor;

    /**
     * list
     */
    public $template_list;
}
