<?php

namespace SyDingTalk\Oapi\V2User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.user.list request
 *
 * @author auto create
 *
 * @since 1.0, 2022.01.17
 */
class ListRequest extends BaseRequest
{
    /**
     * 是否返回访问受限的员工
     */
    private $containAccessLimit;
    /**
     * 游标
     */
    private $cursor;
    /**
     * 部门id
     */
    private $deptId;
    /**
     * 语言
     */
    private $language;
    /**
     * 排序字段，默认custom。或者以下取值entry_asc、entry_desc、modify_asc、modify_desc、custom
     */
    private $orderField;
    /**
     * 分页长度
     */
    private $size;

    public function setContainAccessLimit($containAccessLimit)
    {
        $this->containAccessLimit = $containAccessLimit;
        $this->apiParas['contain_access_limit'] = $containAccessLimit;
    }

    public function getContainAccessLimit()
    {
        return $this->containAccessLimit;
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

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        $this->apiParas['language'] = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setOrderField($orderField)
    {
        $this->orderField = $orderField;
        $this->apiParas['order_field'] = $orderField;
    }

    public function getOrderField()
    {
        return $this->orderField;
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
        return 'dingtalk.oapi.v2.user.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkMaxValue($this->cursor, 100000, 'cursor');
        RequestCheckUtil::checkMinValue($this->cursor, 0, 'cursor');
        RequestCheckUtil::checkNotNull($this->deptId, 'deptId');
        RequestCheckUtil::checkMinValue($this->deptId, 1, 'deptId');
        RequestCheckUtil::checkMaxLength($this->language, 6, 'language');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 100, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
