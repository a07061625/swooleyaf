<?php

namespace SyDingTalk\Oapi\SSO;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sso.gettoken request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetTokenRequest extends BaseRequest
{
    /**
     * 企业Id
     */
    private $corpid;
    /**
     * 这里必须填写专属的SSOSecret
     */
    private $corpsecret;

    public function setCorpid($corpid)
    {
        $this->corpid = $corpid;
        $this->apiParas['corpid'] = $corpid;
    }

    public function getCorpid()
    {
        return $this->corpid;
    }

    public function setCorpsecret($corpsecret)
    {
        $this->corpsecret = $corpsecret;
        $this->apiParas['corpsecret'] = $corpsecret;
    }

    public function getCorpsecret()
    {
        return $this->corpsecret;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sso.gettoken';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
