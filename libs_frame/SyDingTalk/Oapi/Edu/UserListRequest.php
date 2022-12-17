<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.user.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.29
 */
class UserListRequest extends BaseRequest
{
    /**
     * 班级id
     */
    private $classId;
    /**
     * 页码，从1开始
     */
    private $pageNo;
    /**
     * 最大30条，最小1条
     */
    private $pageSize;
    /**
     * 家校人员身份
     */
    private $role;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

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

    public function setRole($role)
    {
        $this->role = $role;
        $this->apiParas['role'] = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.user.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->pageNo, 'pageNo');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->role, 'role');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
