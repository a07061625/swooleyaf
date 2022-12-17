<?php

namespace SyDingTalk\Oapi\Cspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.cspace.auth.generate request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.08
 */
class AuthGenerateRequest extends BaseRequest
{
    /**
     * 微应用的agentId
     */
    private $agentId;
    /**
     * 被授权的应用appId
     */
    private $appId;
    /**
     * 授权码有效期，单位为日，为空则表示永久授权
     */
    private $duration;
    /**
     * 授权访问的文件id列表，id之间用英文逗号隔开，如"fileId1,fileId2", type=download时必须传递
     */
    private $fileIds;
    /**
     * 授权访问的路径，如授权访问所有文件传"/"，授权访问/doc文件夹传"/doc/"，需要utf-8 urlEncode, type=add时必须传递
     */
    private $path;
    /**
     * 权限类型，目前支持上传和预览，上传请传add，预览请传download
     */
    private $type;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['app_id'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        $this->apiParas['duration'] = $duration;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setFileIds($fileIds)
    {
        $this->fileIds = $fileIds;
        $this->apiParas['file_ids'] = $fileIds;
    }

    public function getFileIds()
    {
        return $this->fileIds;
    }

    public function setPath($path)
    {
        $this->path = $path;
        $this->apiParas['path'] = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.cspace.auth.generate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->appId, 'appId');
        RequestCheckUtil::checkMaxListSize($this->fileIds, 20, 'fileIds');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
