<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.appstore.internal.remind request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.09
 */
class InternalRemindRequest extends BaseRequest
{
    /**
     * 商品码
     */
    private $goodsCode;
    /**
     * 试用审批单id
     */
    private $processInstanceId;

    public function setGoodsCode($goodsCode)
    {
        $this->goodsCode = $goodsCode;
        $this->apiParas['goods_code'] = $goodsCode;
    }

    public function getGoodsCode()
    {
        return $this->goodsCode;
    }

    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
        $this->apiParas['process_instance_id'] = $processInstanceId;
    }

    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.appstore.internal.remind';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
