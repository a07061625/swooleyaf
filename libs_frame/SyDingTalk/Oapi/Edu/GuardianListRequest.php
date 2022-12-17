<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.guardian.list request
 * @author auto create
 * @since 1.0, 2021.01.29
 */
class GuardianListRequest extends BaseRequest
{
    /**
     * 班级ID
     **/
    private $classId;
    /**
     * 分页页数
     **/
    private $pageNo;
    /**
     * 每页大小
     **/
    private $pageSize;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas["class_id"] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setPageNo($pageNo)
    {
        $this->pageNo = $pageNo;
        $this->apiParas["page_no"] = $pageNo;
    }

    public function getPageNo()
    {
        return $this->pageNo;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas["page_size"] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.edu.guardian.list";
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, "classId");
        RequestCheckUtil::checkNotNull($this->pageNo, "pageNo");
        RequestCheckUtil::checkNotNull($this->pageSize, "pageSize");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
