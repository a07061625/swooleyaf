<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.user.relation.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.29
 */
class UserRelationGetRequest extends BaseRequest
{
    /**
     * 班级id
     */
    private $classId;
    /**
     * 监护人id
     */
    private $fromUserid;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setFromUserid($fromUserid)
    {
        $this->fromUserid = $fromUserid;
        $this->apiParas['from_userid'] = $fromUserid;
    }

    public function getFromUserid()
    {
        return $this->fromUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.user.relation.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->fromUserid, 'fromUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
