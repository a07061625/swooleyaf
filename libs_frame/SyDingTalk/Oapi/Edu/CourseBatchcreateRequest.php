<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.batchcreate request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.27
 */
class CourseBatchcreateRequest extends BaseRequest
{
    /**
     * course_infos
     */
    private $courseInfos;
    /**
     * 当前用户ID
     */
    private $opUserid;

    public function setCourseInfos($courseInfos)
    {
        $this->courseInfos = $courseInfos;
        $this->apiParas['course_infos'] = $courseInfos;
    }

    public function getCourseInfos()
    {
        return $this->courseInfos;
    }

    public function setOpUserid($opUserid)
    {
        $this->opUserid = $opUserid;
        $this->apiParas['op_userid'] = $opUserid;
    }

    public function getOpUserid()
    {
        return $this->opUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.batchcreate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
