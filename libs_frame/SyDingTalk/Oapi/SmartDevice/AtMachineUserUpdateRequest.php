<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.atmachine.user.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.01
 */
class AtMachineUserUpdateRequest extends BaseRequest
{
    /**
     * 变更智能考勤机员工参数模型
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
        return 'dingtalk.oapi.smartdevice.atmachine.user.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
