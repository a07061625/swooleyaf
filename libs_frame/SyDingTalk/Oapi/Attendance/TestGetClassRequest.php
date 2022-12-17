<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.test.getclass request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class TestGetClassRequest extends BaseRequest
{
    /**
     * 班次
     */
    private $classId;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['classId'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.test.getclass';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
