<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class OpenInvoiceRuleRq
{
    /**
     * 是否适用所有员工
     */
    public $all_employe;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 人员列表
     */
    public $entities;

    /**
     * 第三方发票id
     */
    public $third_part_id;
}
