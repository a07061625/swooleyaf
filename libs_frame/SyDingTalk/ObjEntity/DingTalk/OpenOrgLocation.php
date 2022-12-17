<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 学校的地址信息(如果有)
 *
 * @author auto create
 */
class OpenOrgLocation
{
    /**
     * 学校所在市名称(如果有)
     */
    public $org_loc_city;

    /**
     * 学校所在省名称(如果有)
     */
    public $org_loc_province;

    /**
     * 学校所在区名称(如果有)
     */
    public $org_loc_region;

    /**
     * 学校所在地区编码(如果有)
     */
    public $region_id;
}
