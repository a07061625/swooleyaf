<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * GroupMealSettingVo
 *
 * @author auto create
 */
class GroupMealSettingVo
{
    /**
     * 缩略地址，可为空
     */
    public $address;

    /**
     * 送餐详细地址
     */
    public $address_detail;

    /**
     * 默认地址的id
     */
    public $address_id;

    /**
     * Addressvos
     */
    public $address_list;

    /**
     * 可点餐时间
     */
    public $coming_meal_day_list;

    /**
     * 企业corpId
     */
    public $corp_id;

    /**
     * Mealitemlist
     */
    public $meal_item_list;

    /**
     * 点餐时间枚举值：2-法定工作日3-双休及节假日4- 每天
     */
    public $meal_time;
}
