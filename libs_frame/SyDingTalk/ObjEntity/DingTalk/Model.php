<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * model
 *
 * @author auto create
 */
class Model
{
    /**
     * 业务ID
     */
    public $biz_id;

    /**
     * 产能类型
     */
    public $capacity_type;

    /**
     * 员工列表
     */
    public $emp_list;

    /**
     * 拥有的员工数量
     */
    public $emp_num;

    /**
     * 分组code
     */
    public $group_code;

    /**
     * 系统自动生成
     */
    public $id;

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

    /**
     * 工作日配置
     */
    public $weekday_config_list;

    /**
     * 工段列表
     */
    public $workshop_section_code_list;
}
