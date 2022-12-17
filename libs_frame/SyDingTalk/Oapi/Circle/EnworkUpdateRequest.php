<?php

namespace SyDingTalk\Oapi\Circle;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.circle.enwork.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.18
 */
class EnworkUpdateRequest extends BaseRequest
{
    /**
     * 请求封装类
     */
    private $openUpdateDto;

    public function setOpenUpdateDto($openUpdateDto)
    {
        $this->openUpdateDto = $openUpdateDto;
        $this->apiParas['open_update_dto'] = $openUpdateDto;
    }

    public function getOpenUpdateDto()
    {
        return $this->openUpdateDto;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.circle.enwork.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
