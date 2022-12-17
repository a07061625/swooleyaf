<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.clothes.batch.unscrap request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.14
 */
class MosExecClothesBatchUnscrapRequest extends BaseRequest
{
    /**
     * 入参
     */
    private $batchClothesPerformReq;

    public function setBatchClothesPerformReq($batchClothesPerformReq)
    {
        $this->batchClothesPerformReq = $batchClothesPerformReq;
        $this->apiParas['batch_clothes_perform_req'] = $batchClothesPerformReq;
    }

    public function getBatchClothesPerformReq()
    {
        return $this->batchClothesPerformReq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.clothes.batch.unscrap';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
