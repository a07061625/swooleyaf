<?php

namespace SyDingTalk\SmartWork\Bpms;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.bpms.processinstance.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ProcessInstanceListRequest extends BaseRequest
{
    /**
     * 分页查询的游标，最开始传0，后续传返回参数中的next_cursor值
     */
    private $cursor;
    /**
     * 审批实例结束时间，毫秒级，默认取当前值
     */
    private $endTime;
    /**
     * 流程模板唯一标识，可在oa后台编辑审批表单部分查询
     */
    private $processCode;
    /**
     * 分页参数，每页大小，最多传10
     */
    private $size;
    /**
     * 审批实例开始时间，毫秒级
     */
    private $startTime;
    /**
     * 发起人用户id列表
     */
    private $useridList;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->apiParas['end_time'] = $endTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setProcessCode($processCode)
    {
        $this->processCode = $processCode;
        $this->apiParas['process_code'] = $processCode;
    }

    public function getProcessCode()
    {
        return $this->processCode;
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

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->apiParas['start_time'] = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.smartwork.bpms.processinstance.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processCode, 'processCode');
        RequestCheckUtil::checkNotNull($this->startTime, 'startTime');
        RequestCheckUtil::checkMaxListSize($this->useridList, 20, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
