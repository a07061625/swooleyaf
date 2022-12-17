<?php

namespace SyDingTalk\Corp\Calendar;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.calendar.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class CreateRequest extends BaseRequest
{
    /**
     * 创建日程实体
     */
    private $createVo;

    public function setCreateVo($createVo)
    {
        $this->createVo = $createVo;
        $this->apiParas['create_vo'] = $createVo;
    }

    public function getCreateVo()
    {
        return $this->createVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.calendar.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
