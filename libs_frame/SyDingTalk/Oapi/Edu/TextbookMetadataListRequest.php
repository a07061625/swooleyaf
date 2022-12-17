<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.textbook.metadata.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.22
 */
class TextbookMetadataListRequest extends BaseRequest
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
     * 层级
     */
    private $level;
    /**
     * 用户id
     */
    private $opUserId;
    /**
     * 父教材id
     */
    private $parentId;
    /**
     * 每页条数
     */
    private $size;
    /**
     * 排序规则（0:升序，1:降序）
     */
    private $sortType;
    /**
     * 学科编码
     */
    private $subjectCode;

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

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
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

    public function setSubjectCode($subjectCode)
    {
        $this->subjectCode = $subjectCode;
        $this->apiParas['subject_code'] = $subjectCode;
    }

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.textbook.metadata.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkNotNull($this->subjectCode, 'subjectCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
