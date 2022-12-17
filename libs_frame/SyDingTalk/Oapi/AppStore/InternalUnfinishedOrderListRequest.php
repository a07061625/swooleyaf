<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.internal.unfinishedorder.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class InternalUnfinishedOrderListRequest extends BaseRequest
{
    /**
     * 商品规格码
     */
    private $itemCode;
    /**
     * 分页查询页码，其实页码为1
     */
    private $page;
    /**
     * 分页查询每页大小，最大限制100
     */
    private $pageSize;

    public function setItemCode($itemCode)
    {
        $this->itemCode = $itemCode;
        $this->apiParas['item_code'] = $itemCode;
    }

    public function getItemCode()
    {
        return $this->itemCode;
    }

    public function setPage($page)
    {
        $this->page = $page;
        $this->apiParas['page'] = $page;
    }

    public function getPage()
    {
        return $this->page;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.appstore.internal.unfinishedorder.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->page, 'page');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
