<?php

namespace SyDingTalk\Oapi\File;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.file.upload.single request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class UploadSingleRequest extends BaseRequest
{
    /**
     * 微应用的agentId
     */
    private $agentId;
    /**
     * 文件内容
     */
    private $file;
    /**
     * 文件大小
     */
    private $fileSize;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setFile($file)
    {
        $this->file = $file;
        $this->apiParas['file'] = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
        $this->apiParas['file_size'] = $fileSize;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.file.upload.single';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
