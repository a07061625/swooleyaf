<?php

namespace SyDingTalk\Oapi\Retail;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.retail.user.unionidquery request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.20
 */
class UserUnionIdQueryRequest extends BaseRequest
{
    /**
     * 业务身份
     */
    private $channel;
    /**
     * 主帐号ID
     */
    private $outerId;
    /**
     * 子帐号ID
     */
    private $subOuterId;

    public function setChannel($channel)
    {
        $this->channel = $channel;
        $this->apiParas['channel'] = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setOuterId($outerId)
    {
        $this->outerId = $outerId;
        $this->apiParas['outer_id'] = $outerId;
    }

    public function getOuterId()
    {
        return $this->outerId;
    }

    public function setSubOuterId($subOuterId)
    {
        $this->subOuterId = $subOuterId;
        $this->apiParas['sub_outer_id'] = $subOuterId;
    }

    public function getSubOuterId()
    {
        return $this->subOuterId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.retail.user.unionidquery';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->channel, 'channel');
        RequestCheckUtil::checkNotNull($this->outerId, 'outerId');
        RequestCheckUtil::checkNotNull($this->subOuterId, 'subOuterId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
