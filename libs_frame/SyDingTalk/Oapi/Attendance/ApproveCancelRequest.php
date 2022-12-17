<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.approve.cancel request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.03
 */
class ApproveCancelRequest extends BaseRequest
{
    /**
     * 审批单全局唯一id，最大长度100个字符
     */
    private $approveId;
    /**
     * 钉钉侧审批单全局唯一id，最大长度64个字符
     */
    private $dingtalkApproveId;
    /**
     * 子类型名称，最大长度20个字符
     */
    private $subType;
    /**
     * 审批单类型名称，最大长度20个字符
     */
    private $tagName;
    /**
     * 员工的user_id
     */
    private $userid;

    public function setApproveId($approveId)
    {
        $this->approveId = $approveId;
        $this->apiParas['approve_id'] = $approveId;
    }

    public function getApproveId()
    {
        return $this->approveId;
    }

    public function setDingtalkApproveId($dingtalkApproveId)
    {
        $this->dingtalkApproveId = $dingtalkApproveId;
        $this->apiParas['dingtalk_approve_id'] = $dingtalkApproveId;
    }

    public function getDingtalkApproveId()
    {
        return $this->dingtalkApproveId;
    }

    public function setSubType($subType)
    {
        $this->subType = $subType;
        $this->apiParas['sub_type'] = $subType;
    }

    public function getSubType()
    {
        return $this->subType;
    }

    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
        $this->apiParas['tag_name'] = $tagName;
    }

    public function getTagName()
    {
        return $this->tagName;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.approve.cancel';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxLength($this->approveId, 100, 'approveId');
        RequestCheckUtil::checkMaxLength($this->dingtalkApproveId, 64, 'dingtalkApproveId');
        RequestCheckUtil::checkMaxLength($this->subType, 20, 'subType');
        RequestCheckUtil::checkMaxLength($this->tagName, 20, 'tagName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
