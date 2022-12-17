<?php

namespace SyDingTalk\Oapi\Cspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.cspace.add_to_single_chat request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class AddToSingleChatRequest extends BaseRequest
{
    /**
     * 文件接收人的userid
     */
    private $agentId;
    /**
     * 文件名(需包含含扩展名),需要utf-8 urlEncode
     */
    private $fileName;
    /**
     * 调用钉盘上传文件接口得到的mediaid,需要utf-8 urlEncode
     */
    private $mediaId;
    /**
     * 文件发送者微应用的agentId
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

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        $this->apiParas['file_name'] = $fileName;
    }

    public function getFileName()
    {
        return $this->fileName;
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
        return 'dingtalk.oapi.cspace.add_to_single_chat';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
