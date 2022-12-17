<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.class.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.09
 */
class ClassGetRequest extends BaseRequest
{
    /**
     * 班级ID
     */
    private $classId;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.class.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
