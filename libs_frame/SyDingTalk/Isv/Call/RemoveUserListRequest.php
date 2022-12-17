<?php

namespace SyDingTalk\Isv\Call;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.isv.call.removeuserlist request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class RemoveUserListRequest extends BaseRequest
{
    /**
     * 要删除的员工userid列表
     */
    private $staffIdList;

    public function setStaffIdList($staffIdList)
    {
        $this->staffIdList = $staffIdList;
        $this->apiParas['staff_id_list'] = $staffIdList;
    }

    public function getStaffIdList()
    {
        return $this->staffIdList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.isv.call.removeuserlist';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->staffIdList, 'staffIdList');
        RequestCheckUtil::checkMaxListSize($this->staffIdList, 20, 'staffIdList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
