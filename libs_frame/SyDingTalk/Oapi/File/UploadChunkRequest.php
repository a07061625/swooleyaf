<?php

namespace SyDingTalk\Oapi\File;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.file.upload.chunk request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class UploadChunkRequest extends BaseRequest
{
    /**
     * 微应用的agentId
     */
    private $agentId;
    /**
     * 文件块号，从1开始计数
     */
    private $chunkSequence;
    /**
     * 文件内容
     */
    private $file;
    /**
     * 上传事务id 需要utf-8 urlEncode
     */
    private $uploadId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setChunkSequence($chunkSequence)
    {
        $this->chunkSequence = $chunkSequence;
        $this->apiParas['chunk_sequence'] = $chunkSequence;
    }

    public function getChunkSequence()
    {
        return $this->chunkSequence;
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

    public function setUploadId($uploadId)
    {
        $this->uploadId = $uploadId;
        $this->apiParas['upload_id'] = $uploadId;
    }

    public function getUploadId()
    {
        return $this->uploadId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.file.upload.chunk';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
