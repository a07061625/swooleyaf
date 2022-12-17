<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.class.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ClassListRequest extends BaseRequest
{
    /**
     * 年级ID
     */
    private $gradeId;
    /**
     * 分页页数
     */
    private $pageNo;
    /**
     * 分页每页大小
     */
    private $pageSize;

    public function setGradeId($gradeId)
    {
        $this->gradeId = $gradeId;
        $this->apiParas['grade_id'] = $gradeId;
    }

    public function getGradeId()
    {
        return $this->gradeId;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.class.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->gradeId, 'gradeId');
        RequestCheckUtil::checkNotNull($this->pageNo, 'pageNo');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
