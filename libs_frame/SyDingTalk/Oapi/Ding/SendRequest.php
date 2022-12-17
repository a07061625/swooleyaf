<?php

namespace SyDingTalk\Oapi\Ding;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.ding.send request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.25
 */
class SendRequest extends BaseRequest
{
    /**
     * 发DING的请求体
     */
    private $openDingSendVo;

    public function setOpenDingSendVo($openDingSendVo)
    {
        $this->openDingSendVo = $openDingSendVo;
        $this->apiParas['open_ding_send_vo'] = $openDingSendVo;
    }

    public function getOpenDingSendVo()
    {
        return $this->openDingSendVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ding.send';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
