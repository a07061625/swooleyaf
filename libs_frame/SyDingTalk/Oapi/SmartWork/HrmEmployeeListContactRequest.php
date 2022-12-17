<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.listcontact request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class HrmEmployeeListContactRequest extends BaseRequest
{
    /**
     * 员工id列表
     */
    private $useridList;

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.employee.listcontact';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 50, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
