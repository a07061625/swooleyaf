<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.circle.post.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.24
 */
class CirclePostListRequest extends BaseRequest
{
    /**
     * 1
     */
    private $openFeedQueryParam;

    public function setOpenFeedQueryParam($openFeedQueryParam)
    {
        $this->openFeedQueryParam = $openFeedQueryParam;
        $this->apiParas['open_feed_query_param'] = $openFeedQueryParam;
    }

    public function getOpenFeedQueryParam()
    {
        return $this->openFeedQueryParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.circle.post.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
