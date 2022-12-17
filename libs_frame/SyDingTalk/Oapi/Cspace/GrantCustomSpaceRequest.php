<?php

namespace SyDingTalk\Oapi\Cspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.cspace.grant_custom_space request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.09
 */
class GrantCustomSpaceRequest extends BaseRequest
{
    /**
     * ISV调用时传入，授权访问指定微应用的自定义空间
     */
    private $agentId;
    /**
     * 企业调用时传入，授权访问该domain的自定义空间
     */
    private $domain;
    /**
     * 权限有效时间，有效范围为0~3600秒，超出此范围或不传默认为30秒
     */
    private $duration;
    /**
     * 授权访问的文件id列表，id之间用英文逗号隔开，如“fileId1,fileId2”
     */
    private $fileids;
    /**
     * 授权访问的路径，如授权访问所有文件传“/”，授权访问/doc文件夹传“/doc/” 需要utf-8 urlEncode
     */
    private $path;
    /**
     * 权限类型，目前支持上传和下载，上传请传add，下载请传download
     */
    private $type;
    /**
     * 企业用户userid
     */
    private $userid;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        $this->apiParas['domain'] = $domain;
    }

    public function getDomain()
    {
        return $this->domain;
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

    public function setFileids($fileids)
    {
        $this->fileids = $fileids;
        $this->apiParas['fileids'] = $fileids;
    }

    public function getFileids()
    {
        return $this->fileids;
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

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.cspace.grant_custom_space';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
