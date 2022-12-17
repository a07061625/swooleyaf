<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.device.querylist request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.28
 */
class DeviceQueryListRequest extends BaseRequest
{
    /**
     * 列表查询对象
     */
    private $pageQueryVo;

    public function setPageQueryVo($pageQueryVo)
    {
        $this->pageQueryVo = $pageQueryVo;
        $this->apiParas['page_query_vo'] = $pageQueryVo;
    }

    public function getPageQueryVo()
    {
        return $this->pageQueryVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.device.querylist';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
