<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.operation.condition.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.03
 */
class MosExecOperationConditionGetRequest extends BaseRequest
{
    /**
     * 请求
     */
    private $getClothesConditionReq;

    public function setGetClothesConditionReq($getClothesConditionReq)
    {
        $this->getClothesConditionReq = $getClothesConditionReq;
        $this->apiParas['get_clothes_condition_req'] = $getClothesConditionReq;
    }

    public function getGetClothesConditionReq()
    {
        return $this->getClothesConditionReq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.operation.condition.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
