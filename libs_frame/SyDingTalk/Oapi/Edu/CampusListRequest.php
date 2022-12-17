<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.campus.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class CampusListRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.campus.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
