<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.batch.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.14
 */
class MosExecPerformBatchCreateRequest extends BaseRequest
{
    /**
     * 入参
     */
    private $batchCreateOperationReq;

    public function setBatchCreateOperationReq($batchCreateOperationReq)
    {
        $this->batchCreateOperationReq = $batchCreateOperationReq;
        $this->apiParas['batch_create_operation_req'] = $batchCreateOperationReq;
    }

    public function getBatchCreateOperationReq()
    {
        return $this->batchCreateOperationReq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.perform.batch.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
