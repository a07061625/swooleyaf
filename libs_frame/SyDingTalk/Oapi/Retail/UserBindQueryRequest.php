<?php

namespace SyDingTalk\Oapi\Retail;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.retail.user.bindquery request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.09
 */
class UserBindQueryRequest extends BaseRequest
{
    /**
     * 虚拟组织下的唯一ID
     */
    private $associateUnionId;
    /**
     * 业务身份
     */
    private $channel;

    public function setAssociateUnionId($associateUnionId)
    {
        $this->associateUnionId = $associateUnionId;
        $this->apiParas['associate_union_id'] = $associateUnionId;
    }

    public function getAssociateUnionId()
    {
        return $this->associateUnionId;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;
        $this->apiParas['channel'] = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.retail.user.bindquery';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
