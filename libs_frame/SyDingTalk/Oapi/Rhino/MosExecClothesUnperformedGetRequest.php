<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.clothes.unperformed.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.24
 */
class MosExecClothesUnperformedGetRequest extends BaseRequest
{
    /**
     * 入参
     */
    private $req;

    public function setReq($req)
    {
        $this->req = $req;
        $this->apiParas['req'] = $req;
    }

    public function getReq()
    {
        return $this->req;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.clothes.unperformed.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
