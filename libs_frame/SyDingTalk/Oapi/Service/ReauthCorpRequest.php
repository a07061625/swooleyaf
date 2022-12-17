<?php

namespace SyDingTalk\Oapi\Service;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.service.reauth_corp request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class ReauthCorpRequest extends BaseRequest
{
    /**
     * 套件下的微应用ID
     */
    private $appId;
    /**
     * 未激活的corpid列表
     */
    private $corpidList;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['app_id'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setCorpidList($corpidList)
    {
        $this->corpidList = $corpidList;
        $this->apiParas['corpid_list'] = $corpidList;
    }

    public function getCorpidList()
    {
        return $this->corpidList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.service.reauth_corp';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->corpidList, 20, 'corpidList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
