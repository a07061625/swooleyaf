<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.visitor.addvisitor request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class VisitorAddVisitorRequest extends BaseRequest
{
    /**
     * 访客预约模型
     */
    private $visitorVo;

    public function setVisitorVo($visitorVo)
    {
        $this->visitorVo = $visitorVo;
        $this->apiParas['visitor_vo'] = $visitorVo;
    }

    public function getVisitorVo()
    {
        return $this->visitorVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.visitor.addvisitor';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
