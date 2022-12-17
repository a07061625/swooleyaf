<?php

namespace SyDingTalk\Oapi\Statistics;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.statistics.details request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class DetailsRequest extends BaseRequest
{
    /**
     * 业务类型，目前有employee,group, live
     */
    private $type;

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.statistics.details';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
