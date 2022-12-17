<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.subject.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.14
 */
class SubjectListRequest extends BaseRequest
{
    /**
     * 游标
     */
    private $cursor;
    /**
     * 排序依赖字段类型
     */
    private $dataOrderType;
    /**
     * 用户id
     */
    private $operatorUserid;
    /**
     * 学段编码
     */
    private $periodCode;
    /**
     * 每页数据条数
     */
    private $size;
    /**
     * 排序规则（0:升序，1:降序）
     */
    private $sortType;
    /**
     * 学科编码列表
     */
    private $subjectCodeList;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setDataOrderType($dataOrderType)
    {
        $this->dataOrderType = $dataOrderType;
        $this->apiParas['data_order_type'] = $dataOrderType;
    }

    public function getDataOrderType()
    {
        return $this->dataOrderType;
    }

    public function setOperatorUserid($operatorUserid)
    {
        $this->operatorUserid = $operatorUserid;
        $this->apiParas['operator_userid'] = $operatorUserid;
    }

    public function getOperatorUserid()
    {
        return $this->operatorUserid;
    }

    public function setPeriodCode($periodCode)
    {
        $this->periodCode = $periodCode;
        $this->apiParas['period_code'] = $periodCode;
    }

    public function getPeriodCode()
    {
        return $this->periodCode;
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

    public function setSortType($sortType)
    {
        $this->sortType = $sortType;
        $this->apiParas['sort_type'] = $sortType;
    }

    public function getSortType()
    {
        return $this->sortType;
    }

    public function setSubjectCodeList($subjectCodeList)
    {
        $this->subjectCodeList = $subjectCodeList;
        $this->apiParas['subject_code_list'] = $subjectCodeList;
    }

    public function getSubjectCodeList()
    {
        return $this->subjectCodeList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.subject.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->operatorUserid, 'operatorUserid');
        RequestCheckUtil::checkNotNull($this->periodCode, 'periodCode');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxListSize($this->subjectCodeList, 999, 'subjectCodeList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
