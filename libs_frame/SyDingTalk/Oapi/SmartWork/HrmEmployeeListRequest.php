<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.02
 */
class HrmEmployeeListRequest extends BaseRequest
{
    /**
     * 微应用在企业的agentId
     */
    private $agentid;
    /**
     * 需要获取的花名册字段信息
     */
    private $fieldFilterList;
    /**
     * 员工id列表
     */
    private $useridList;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setFieldFilterList($fieldFilterList)
    {
        $this->fieldFilterList = $fieldFilterList;
        $this->apiParas['field_filter_list'] = $fieldFilterList;
    }

    public function getFieldFilterList()
    {
        return $this->fieldFilterList;
    }

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
        return 'dingtalk.oapi.smartwork.hrm.employee.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->fieldFilterList, 100, 'fieldFilterList');
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 50, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
