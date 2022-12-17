<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.printer.instance.get request
 * @author auto create
 * @since 1.0, 2020.04.08
 */
class PrinterInstanceGetRequest extends BaseRequest
{
    /**
     * 脱敏数据请求
     **/
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas["request"] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.process.printer.instance.get";
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
