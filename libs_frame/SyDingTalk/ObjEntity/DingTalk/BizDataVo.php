<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 业务数据
 *
 * @author auto create
 */
class BizDataVo
{
    /**
     * 数据业务时间戳
     */
    public $biz_time;

    /**
     * 业务uk，唯一标识一条流水
     */
    public $biz_uk;

    /**
     * 字段列表
     */
    public $fields;

    /**
     * 数据所属业务域
     */
    public $scope;

    /**
     * 员工id
     */
    public $userid;
}
