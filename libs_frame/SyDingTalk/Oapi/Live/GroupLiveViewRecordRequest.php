<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.live.grouplive.viewrecord request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.07
 */
class GroupLiveViewRecordRequest extends BaseRequest
{
    /**
     * 部门id
     */
    private $deptId;
    /**
     * 直播uuid
     */
    private $liveUuid;
    /**
     * 分页拉取
     */
    private $pageIndex;
    /**
     * 一页多少数据，默认100
     */
    private $pageSize;

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setLiveUuid($liveUuid)
    {
        $this->liveUuid = $liveUuid;
        $this->apiParas['live_uuid'] = $liveUuid;
    }

    public function getLiveUuid()
    {
        return $this->liveUuid;
    }

    public function setPageIndex($pageIndex)
    {
        $this->pageIndex = $pageIndex;
        $this->apiParas['page_index'] = $pageIndex;
    }

    public function getPageIndex()
    {
        return $this->pageIndex;
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
        return 'dingtalk.oapi.live.grouplive.viewrecord';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deptId, 'deptId');
        RequestCheckUtil::checkNotNull($this->liveUuid, 'liveUuid');
        RequestCheckUtil::checkNotNull($this->pageIndex, 'pageIndex');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
