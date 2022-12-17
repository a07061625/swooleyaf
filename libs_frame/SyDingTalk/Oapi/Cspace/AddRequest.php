<?php

namespace SyDingTalk\Oapi\Cspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.cspace.add request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class AddRequest extends BaseRequest
{
    /**
     * 微应用的agentId
     */
    private $agentId;
    /**
     * 如果是微应用，code值为微应用免登授权码,如果是服务窗应用，code值为服务窗免登授权码。code为临时授权码，只能消费一次，下次请求需要重新获取新的code。
     */
    private $code;
    /**
     * 调用云盘选择控件后获取的用户钉盘空间ID
     */
    private $folderId;
    /**
     * 调用钉盘上传文件接口得到的mediaid, 需要utf-8 urlEncode
     */
    private $mediaId;
    /**
     * 上传文件的名称，不能包含非法字符，需要utf-8 urlEncode
     */
    private $name;
    /**
     * 遇到同名文件是否覆盖，若不覆盖，则会自动重命名本次新增的文件，默认为false
     */
    private $overwrite;
    /**
     * 调用云盘选择控件后获取的用户钉盘文件夹ID
     */
    private $spaceId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setCode($code)
    {
        $this->code = $code;
        $this->apiParas['code'] = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;
        $this->apiParas['folder_id'] = $folderId;
    }

    public function getFolderId()
    {
        return $this->folderId;
    }

    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->apiParas['media_id'] = $mediaId;
    }

    public function getMediaId()
    {
        return $this->mediaId;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setOverwrite($overwrite)
    {
        $this->overwrite = $overwrite;
        $this->apiParas['overwrite'] = $overwrite;
    }

    public function getOverwrite()
    {
        return $this->overwrite;
    }

    public function setSpaceId($spaceId)
    {
        $this->spaceId = $spaceId;
        $this->apiParas['space_id'] = $spaceId;
    }

    public function getSpaceId()
    {
        return $this->spaceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.cspace.add';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
