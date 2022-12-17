<?php

namespace SyDingTalk\Corp\Report;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.report.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ListRequest extends BaseRequest
{
    /**
     * 查询游标，初始传入0，后续从上一次的返回值中获取
     */
    private $cursor;
    /**
     * 查询截止时间
     */
    private $endTime;
    /**
     * 每页数据量
     */
    private $size;
    /**
     * 查询起始时间
     */
    private $startTime;
    /**
     * 要查询的模板名称
     */
    private $templateName;
    /**
     * 员工的userid
     */
    private $userid;

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

    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
        $this->apiParas['template_name'] = $templateName;
    }

    public function getTemplateName()
    {
        return $this->templateName;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.report.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->endTime, 'endTime');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkNotNull($this->startTime, 'startTime');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
