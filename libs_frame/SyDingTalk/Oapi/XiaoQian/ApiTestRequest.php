<?php

namespace SyDingTalk\Oapi\XiaoQian;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.xiaoqian.api.test request
 *
 * @author auto create
 *
 * @since 1.0, 2022.03.10
 */
class ApiTestRequest extends BaseRequest
{
    /**
     * 工单id123456
     */
    private $id;

    public function setId($id)
    {
        $this->id = $id;
        $this->apiParas['id'] = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.xiaoqian.api.test';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
