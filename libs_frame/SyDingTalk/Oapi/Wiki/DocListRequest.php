<?php

namespace SyDingTalk\Oapi\Wiki;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.wiki.doc.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.16
 */
class DocListRequest extends BaseRequest
{
    /**
     * 应用agentId
     */
    private $agentid;
    /**
     * 分页游标（默认0）
     */
    private $cursor;
    /**
     * 知识本ID（加密后的值）
     */
    private $repoId;
    /**
     * 分页大小（默认20）
     */
    private $size;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setRepoId($repoId)
    {
        $this->repoId = $repoId;
        $this->apiParas['repo_id'] = $repoId;
    }

    public function getRepoId()
    {
        return $this->repoId;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.wiki.doc.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentid, 'agentid');
        RequestCheckUtil::checkNotNull($this->repoId, 'repoId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
