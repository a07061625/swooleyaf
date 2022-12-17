<?php

namespace SyDingTalk\Oapi\Relation;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.relation.remark.modify request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class RemarkModifyRequest extends BaseRequest
{
    /**
     * 系统自动生成
     */
    private $markees;
    /**
     * 修改者的userid
     */
    private $markers;

    public function setMarkees($markees)
    {
        $this->markees = $markees;
        $this->apiParas['markees'] = $markees;
    }

    public function getMarkees()
    {
        return $this->markees;
    }

    public function setMarkers($markers)
    {
        $this->markers = $markers;
        $this->apiParas['markers'] = $markers;
    }

    public function getMarkers()
    {
        return $this->markers;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.relation.remark.modify';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->markers, 'markers');
        RequestCheckUtil::checkMaxListSize($this->markers, 100, 'markers');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
