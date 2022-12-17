<?php

namespace SyDingTalk\Oapi\DingMi;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.dingmi.robot.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.23
 */
class RobotGetRequest extends BaseRequest
{
    /**
     * 服务号：1，群：2
     */
    private $type;

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingmi.robot.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
