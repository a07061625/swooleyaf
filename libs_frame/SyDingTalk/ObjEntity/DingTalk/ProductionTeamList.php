<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 拥有的生产组
 *
 * @author auto create
 */
class ProductionTeamList
{
    /**
     * 生产组业务ID
     */
    public $biz_id;

    /**
     * 产能类型
     */
    public $capacity_type;

    /**
     * 是否删除
     */
    public $deleted;

    /**
     * 员工数量
     */
    public $emp_num;

    /**
     * 分组code
     */
    public $group_code;

    /**
     * modifier
     */
    public $modifier;

    /**
     * 生产组code
     */
    public $production_team_code;

    /**
     * 生产组名称
     */
    public $production_team_name;

    /**
     * 资产ID
     */
    public $tenant_id;
}
