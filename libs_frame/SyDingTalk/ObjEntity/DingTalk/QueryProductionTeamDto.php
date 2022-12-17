<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 查询生产组入参
 *
 * @author auto create
 */
class QueryProductionTeamDto
{
    /**
     * 结束时间
     */
    public $end_time;

    /**
     * 开始时间
     */
    public $start_time;

    /**
     * 资产ID
     */
    public $tenant_id;

    /**
     * 预业务参数[这里先预留],这里是用户ID,比如钉钉用户ID
     */
    public $userid;

    /**
     * 工段CODE
     */
    public $workshop_section_code;
}
