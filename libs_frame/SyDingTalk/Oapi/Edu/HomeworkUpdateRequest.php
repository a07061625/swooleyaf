<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.29
 */
class HomeworkUpdateRequest extends BaseRequest
{
    /**
     * 业务编码
     */
    private $bizCode;
    /**
     * 作业ID
     */
    private $hwId;
    /**
     * 幂等标识
     */
    private $identifier;
    /**
     * 状态
     */
    private $status;
    /**
     * 老师UserId
     */
    private $teacherUserid;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setHwId($hwId)
    {
        $this->hwId = $hwId;
        $this->apiParas['hw_id'] = $hwId;
    }

    public function getHwId()
    {
        return $this->hwId;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        $this->apiParas['identifier'] = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setTeacherUserid($teacherUserid)
    {
        $this->teacherUserid = $teacherUserid;
        $this->apiParas['teacher_userid'] = $teacherUserid;
    }

    public function getTeacherUserid()
    {
        return $this->teacherUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->hwId, 'hwId');
        RequestCheckUtil::checkNotNull($this->identifier, 'identifier');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkNotNull($this->teacherUserid, 'teacherUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
