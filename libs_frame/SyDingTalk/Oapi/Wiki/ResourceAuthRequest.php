<?php

namespace SyDingTalk\Oapi\Wiki;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.wiki.resource.auth request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.28
 */
class ResourceAuthRequest extends BaseRequest
{
    /**
     * 应用agentId
     */
    private $agentid;
    /**
     * 个人授权信息
     */
    private $authCode;
    /**
     * 是否是公开发布的知识库
     */
    private $isPublic;
    /**
     * 请求授权的资源列表
     */
    private $resourceList;
    /**
     * 1:知识库，2:知识本，3:知识页
     */
    private $resourceType;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
        $this->apiParas['auth_code'] = $authCode;
    }

    public function getAuthCode()
    {
        return $this->authCode;
    }

    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
        $this->apiParas['is_public'] = $isPublic;
    }

    public function getIsPublic()
    {
        return $this->isPublic;
    }

    public function setResourceList($resourceList)
    {
        $this->resourceList = $resourceList;
        $this->apiParas['resource_list'] = $resourceList;
    }

    public function getResourceList()
    {
        return $this->resourceList;
    }

    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;
        $this->apiParas['resource_type'] = $resourceType;
    }

    public function getResourceType()
    {
        return $this->resourceType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.wiki.resource.auth';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentid, 'agentid');
        RequestCheckUtil::checkNotNull($this->authCode, 'authCode');
        RequestCheckUtil::checkNotNull($this->isPublic, 'isPublic');
        RequestCheckUtil::checkNotNull($this->resourceList, 'resourceList');
        RequestCheckUtil::checkMaxListSize($this->resourceList, 999, 'resourceList');
        RequestCheckUtil::checkNotNull($this->resourceType, 'resourceType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
