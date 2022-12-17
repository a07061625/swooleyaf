<?php

namespace SyDingTalk\Oapi\OpenEncrypt;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.openencrypt.rotateedk request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.09
 */
class RotateEdkRequest extends BaseRequest
{
    /**
     * 请求参数
     */
    private $topEdkRotateManual;

    public function setTopEdkRotateManual($topEdkRotateManual)
    {
        $this->topEdkRotateManual = $topEdkRotateManual;
        $this->apiParas['top_edk_rotate_manual'] = $topEdkRotateManual;
    }

    public function getTopEdkRotateManual()
    {
        return $this->topEdkRotateManual;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.openencrypt.rotateedk';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
