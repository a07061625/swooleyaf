<?php

namespace SyDingTalk\Oapi\Org;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.org.setoaurl request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.12
 */
class SetOaUrlRequest extends BaseRequest
{
    /**
     * 工作台名称，认证企业才能设置
     */
    private $oaTitle;
    /**
     * 工作台首页地址，必须是https开头
     */
    private $oaUrl;

    public function setOaTitle($oaTitle)
    {
        $this->oaTitle = $oaTitle;
        $this->apiParas['oa_title'] = $oaTitle;
    }

    public function getOaTitle()
    {
        return $this->oaTitle;
    }

    public function setOaUrl($oaUrl)
    {
        $this->oaUrl = $oaUrl;
        $this->apiParas['oa_url'] = $oaUrl;
    }

    public function getOaUrl()
    {
        return $this->oaUrl;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.org.setoaurl';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->oaUrl, 'oaUrl');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
