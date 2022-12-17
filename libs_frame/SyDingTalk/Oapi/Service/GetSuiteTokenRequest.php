<?php

namespace SyDingTalk\Oapi\Service;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.service.get_suite_token request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.07
 */
class GetSuiteTokenRequest extends BaseRequest
{
    /**
     * 套件key，开发者后台创建套件后获取
     */
    private $suiteKey;
    /**
     * 套件secret，开发者后台创建套件后获取
     */
    private $suiteSecret;
    /**
     * 钉钉推送的ticket
     */
    private $suiteTicket;

    public function setSuiteKey($suiteKey)
    {
        $this->suiteKey = $suiteKey;
        $this->apiParas['suite_key'] = $suiteKey;
    }

    public function getSuiteKey()
    {
        return $this->suiteKey;
    }

    public function setSuiteSecret($suiteSecret)
    {
        $this->suiteSecret = $suiteSecret;
        $this->apiParas['suite_secret'] = $suiteSecret;
    }

    public function getSuiteSecret()
    {
        return $this->suiteSecret;
    }

    public function setSuiteTicket($suiteTicket)
    {
        $this->suiteTicket = $suiteTicket;
        $this->apiParas['suite_ticket'] = $suiteTicket;
    }

    public function getSuiteTicket()
    {
        return $this->suiteTicket;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.service.get_suite_token';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
