<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.subject.metadata.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.14
 */
class SubjectMetadataListRequest extends BaseRequest
{
    /**
     * 地区编码
     */
    private $areaCode;
    /**
     * 游标
     */
    private $cursor;
    /**
     * 排序依赖字段类型
     */
    private $dataOrderType;
    /**
     * 层级
     */
    private $level;
    /**
     * 用户id
     */
    private $operatorUserid;
    /**
     * 父id
     */
    private $parentId;
    /**
     * 学段编码
     */
    private $periodCode;
    /**
     * 每页数据条数
     */
    private $size;
    /**
     * 排序方式 （0:正序，1:倒序）
     */
    private $sortType;

    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
        $this->apiParas['area_code'] = $areaCode;
    }

    public function getAreaCode()
    {
        return $this->areaCode;
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

    public function setDataOrderType($dataOrderType)
    {
        $this->dataOrderType = $dataOrderType;
        $this->apiParas['data_order_type'] = $dataOrderType;
    }

    public function getDataOrderType()
    {
        return $this->dataOrderType;
    }

    public function setLevel($level)
    {
        $this->level = $level;
        $this->apiParas['level'] = $level;
    }

    public function getLevel()
    {
        return $this->level;
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

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        $this->apiParas['parent_id'] = $parentId;
    }

    public function getParentId()
    {
        return $this->parentId;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.subject.metadata.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->areaCode, 'areaCode');
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->operatorUserid, 'operatorUserid');
        RequestCheckUtil::checkNotNull($this->periodCode, 'periodCode');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
