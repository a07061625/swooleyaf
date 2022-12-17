<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.dept.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.23
 */
class DeptListRequest extends BaseRequest
{
    /**
     * 页码，从1开始
     */
    private $pageNo;
    /**
     * 每页大小，最大30
     */
    private $pageSize;
    /**
     * 父部门节点id，如果不填，则默认获取第一层级的部门节点
     */
    private $superId;

    public function setPageNo($pageNo)
    {
        $this->pageNo = $pageNo;
        $this->apiParas['page_no'] = $pageNo;
    }

    public function getPageNo()
    {
        return $this->pageNo;
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

    public function setSuperId($superId)
    {
        $this->superId = $superId;
        $this->apiParas['super_id'] = $superId;
    }

    public function getSuperId()
    {
        return $this->superId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.dept.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->pageNo, 'pageNo');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
