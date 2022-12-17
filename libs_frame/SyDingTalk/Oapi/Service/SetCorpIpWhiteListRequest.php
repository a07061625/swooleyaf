<?php

namespace SyDingTalk\Oapi\Service;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.service.set_corp_ipwhitelist request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class SetCorpIpWhiteListRequest extends BaseRequest
{
    /**
     * 授权方corpid
     */
    private $authCorpid;
    /**
     * 要为其设置的IP白名单,格式支持IP段,用星号表示,如【5.6.*.*】,代表从【5.6.0.*】到【5.6.255.*】的任意IP,在第三段设为星号时,将忽略第四段的值,注意:仅支持后两段设置为星号
     */
    private $ipWhitelist;

    public function setAuthCorpid($authCorpid)
    {
        $this->authCorpid = $authCorpid;
        $this->apiParas['auth_corpid'] = $authCorpid;
    }

    public function getAuthCorpid()
    {
        return $this->authCorpid;
    }

    public function setIpWhitelist($ipWhitelist)
    {
        $this->ipWhitelist = $ipWhitelist;
        $this->apiParas['ip_whitelist'] = $ipWhitelist;
    }

    public function getIpWhitelist()
    {
        return $this->ipWhitelist;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.service.set_corp_ipwhitelist';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->ipWhitelist, 20, 'ipWhitelist');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
