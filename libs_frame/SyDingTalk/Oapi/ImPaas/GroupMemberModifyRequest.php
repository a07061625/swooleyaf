<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.impaas.groupmember.modify request
 * @author auto create
 * @since 1.0, 2019.07.01
 */
class GroupMemberModifyRequest extends BaseRequest
{
    /**
     * 修改群成员列表入参
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
        return "dingtalk.oapi.impaas.groupmember.modify";
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
