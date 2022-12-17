<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 城市列表
 *
 * @author auto create
 */
class CityVo
{
    /**
     * 三字码
     */
    public $code;

    /**
     * 与搜索城市距离，单位千米，只在邻近机场推荐有值
     */
    public $distance;

    /**
     * 城市名称
     */
    public $name;

    /**
     * 邻近机场城市，只在邻近机场推荐有值
     */
    public $travel_name;
}
