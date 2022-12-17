<?php

namespace SyDingTalk\Oapi\File;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.file.upload.transaction request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class UploadTransactionRequest extends BaseRequest
{
    /**
     * 微应用的agentId
     */
    private $agentId;
    /**
     * 文件总块数
     */
    private $chunkNumbers;
    /**
     * 文件大小
     */
    private $fileSize;
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

    public function setChunkNumbers($chunkNumbers)
    {
        $this->chunkNumbers = $chunkNumbers;
        $this->apiParas['chunk_numbers'] = $chunkNumbers;
    }

    public function getChunkNumbers()
    {
        return $this->chunkNumbers;
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
        return 'dingtalk.oapi.file.upload.transaction';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
