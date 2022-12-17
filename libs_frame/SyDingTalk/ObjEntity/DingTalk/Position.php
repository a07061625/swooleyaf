<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * position列表
 *
 * @author auto create
 */
class Position
{
    /**
     * 地址描述
     */
    public $address;

    /**
     * 纬度(支持6位小数)
     */
    public $latitude;

    /**
     * 经度(支持6位小数)
     */
    public $longitude;

    /**
     * 打卡位置允许的偏移量
     */
    public $offset;

    /**
     * positionKey
     */
    public $position_key;
}
