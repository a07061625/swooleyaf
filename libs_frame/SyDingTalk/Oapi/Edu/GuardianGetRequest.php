<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.guardian.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.29
 */
class GuardianGetRequest extends BaseRequest
{
    /**
     * 班级ID
     */
    private $classId;
    /**
     * 家长ID
     */
    private $guardianUserid;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setGuardianUserid($guardianUserid)
    {
        $this->guardianUserid = $guardianUserid;
        $this->apiParas['guardian_userid'] = $guardianUserid;
    }

    public function getGuardianUserid()
    {
        return $this->guardianUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.guardian.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->guardianUserid, 'guardianUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
