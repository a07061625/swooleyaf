<?php

namespace SyDingTalk\Oapi\Inactive;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.inactive.user.v2.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.13
 */
class UserV2GetRequest extends BaseRequest
{
    /**
     * 过滤部门id列表，不传表示查询整个企业
     */
    private $deptIds;
    /**
     * 是否活跃 false不活跃 true 活跃
     */
    private $isActive;
    /**
     * 获取数据偏移量，第一页使用0，后面页使用接口返回的nextCursor
     */
    private $offset;
    /**
     * 查询日期, 日期格式yyyyMMdd
     */
    private $queryDate;
    /**
     * 获取数据size,最大100
     */
    private $size;

    public function setDeptIds($deptIds)
    {
        $this->deptIds = $deptIds;
        $this->apiParas['dept_ids'] = $deptIds;
    }

    public function getDeptIds()
    {
        return $this->deptIds;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        $this->apiParas['is_active'] = $isActive;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setQueryDate($queryDate)
    {
        $this->queryDate = $queryDate;
        $this->apiParas['query_date'] = $queryDate;
    }

    public function getQueryDate()
    {
        return $this->queryDate;
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
        return 'dingtalk.oapi.inactive.user.v2.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->deptIds, 100, 'deptIds');
        RequestCheckUtil::checkNotNull($this->isActive, 'isActive');
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->queryDate, 'queryDate');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
