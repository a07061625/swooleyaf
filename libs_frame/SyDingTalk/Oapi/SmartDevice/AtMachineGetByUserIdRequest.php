<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.atmachine.get_by_userid request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.09
 */
class AtMachineGetByUserIdRequest extends BaseRequest
{
    /**
     * 查询智能考勤机列表参数模型
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
        return 'dingtalk.oapi.smartdevice.atmachine.get_by_userid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
