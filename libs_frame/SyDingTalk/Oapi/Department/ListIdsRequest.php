<?php

namespace SyDingTalk\Oapi\Department;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.department.list_ids request
 * @author auto create
 * @since 1.0, 2018.07.25
 */
class ListIdsRequest extends BaseRequest
{
    /**
     * 部门id
     **/
    private $id;

    public function setId($id)
    {
        $this->id = $id;
        $this->apiParas["id"] = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.department.list_ids";
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
