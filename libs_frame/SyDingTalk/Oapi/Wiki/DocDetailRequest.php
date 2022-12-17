<?php

namespace SyDingTalk\Oapi\Wiki;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.wiki.doc.detail request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.16
 */
class DocDetailRequest extends BaseRequest
{
    /**
     * 应用agentId
     */
    private $agentid;
    /**
     * 知识页ID（加密后的值）
     */
    private $docId;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setDocId($docId)
    {
        $this->docId = $docId;
        $this->apiParas['doc_id'] = $docId;
    }

    public function getDocId()
    {
        return $this->docId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.wiki.doc.detail';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentid, 'agentid');
        RequestCheckUtil::checkNotNull($this->docId, 'docId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
