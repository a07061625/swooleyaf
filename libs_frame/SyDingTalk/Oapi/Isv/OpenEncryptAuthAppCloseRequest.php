<?php

namespace SyDingTalk\Oapi\Isv;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.isv.openencrypt.authappclose request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.23
 */
class OpenEncryptAuthAppCloseRequest extends BaseRequest
{
    /**
     * 请求参数
     */
    private $topAuthMicroAppClose;

    public function setTopAuthMicroAppClose($topAuthMicroAppClose)
    {
        $this->topAuthMicroAppClose = $topAuthMicroAppClose;
        $this->apiParas['top_auth_micro_app_close'] = $topAuthMicroAppClose;
    }

    public function getTopAuthMicroAppClose()
    {
        return $this->topAuthMicroAppClose;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.isv.openencrypt.authappclose';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
