<?php

namespace SyDingTalk\Oapi\Service;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.service.get_auth_info request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.21
 */
class GetAuthInfoRequest extends BaseRequest
{
    /**
     * 授权方corpid
     */
    private $authCorpid;
    /**
     * 套件key
     */
    private $suiteKey;

    public function setAuthCorpid($authCorpid)
    {
        $this->authCorpid = $authCorpid;
        $this->apiParas['auth_corpid'] = $authCorpid;
    }

    public function getAuthCorpid()
    {
        return $this->authCorpid;
    }

    public function setSuiteKey($suiteKey)
    {
        $this->suiteKey = $suiteKey;
        $this->apiParas['suite_key'] = $suiteKey;
    }

    public function getSuiteKey()
    {
        return $this->suiteKey;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.service.get_auth_info';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
