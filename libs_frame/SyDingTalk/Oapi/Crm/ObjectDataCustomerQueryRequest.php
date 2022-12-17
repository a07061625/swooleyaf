<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.customer.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.27
 */
class ObjectDataCustomerQueryRequest extends BaseRequest
{
    /**
     * 用户ID
     */
    private $currentOperatorUserid;
    /**
     * 分页游标
     */
    private $cursor;
    /**
     * 分页大小
     */
    private $pageSize;
    /**
     * 查询条件
     */
    private $queryDsl;

    public function setCurrentOperatorUserid($currentOperatorUserid)
    {
        $this->currentOperatorUserid = $currentOperatorUserid;
        $this->apiParas['current_operator_userid'] = $currentOperatorUserid;
    }

    public function getCurrentOperatorUserid()
    {
        return $this->currentOperatorUserid;
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

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['page_size'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setQueryDsl($queryDsl)
    {
        $this->queryDsl = $queryDsl;
        $this->apiParas['query_dsl'] = $queryDsl;
    }

    public function getQueryDsl()
    {
        return $this->queryDsl;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectdata.customer.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
