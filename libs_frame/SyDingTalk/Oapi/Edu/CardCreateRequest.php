<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.card.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.31
 */
class CardCreateRequest extends BaseRequest
{
    /**
     * 参数
     */
    private $opencardcreateparam;

    public function setOpencardcreateparam($opencardcreateparam)
    {
        $this->opencardcreateparam = $opencardcreateparam;
        $this->apiParas['opencardcreateparam'] = $opencardcreateparam;
    }

    public function getOpencardcreateparam()
    {
        return $this->opencardcreateparam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.card.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
