<?php

namespace SyDingTalk\Oapi\Pbp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.pbp.event.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.29
 */
class EventSyncRequest extends BaseRequest
{
    /**
     * 打卡事件参数模型
     */
    private $param;

    public function setParam($param)
    {
        $this->param = $param;
        $this->apiParas['param'] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.pbp.event.sync';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
