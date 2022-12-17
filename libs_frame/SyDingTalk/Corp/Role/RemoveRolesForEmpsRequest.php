<?php

namespace SyDingTalk\Corp\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.role.removerolesforemps request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class RemoveRolesForEmpsRequest extends BaseRequest
{
    /**
     * 角色标签id
     */
    private $roleidList;
    /**
     * 用户userId
     */
    private $useridList;

    public function setRoleidList($roleidList)
    {
        $this->roleidList = $roleidList;
        $this->apiParas['roleid_list'] = $roleidList;
    }

    public function getRoleidList()
    {
        return $this->roleidList;
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
        return 'dingtalk.corp.role.removerolesforemps';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->roleidList, 'roleidList');
        RequestCheckUtil::checkMaxListSize($this->roleidList, 20, 'roleidList');
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 100, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
