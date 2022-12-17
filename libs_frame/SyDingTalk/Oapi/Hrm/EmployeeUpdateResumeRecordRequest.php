<?php

namespace SyDingTalk\Oapi\Hrm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.hrm.employee.updateresumerecord request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class EmployeeUpdateResumeRecordRequest extends BaseRequest
{
    /**
     * 成长记录第一条内容
     */
    private $content;
    /**
     * 成长记录kv展示内容：json格式，顺序展示
     */
    private $kVContent;
    /**
     * pc端url
     */
    private $pcUrl;
    /**
     * 手机端url
     */
    private $phoneUrl;
    /**
     * 20180428 零点零分零秒
     */
    private $recordTimestamp;
    /**
     * 成长记录唯一标识
     */
    private $resumeId;
    /**
     * 成长记录title
     */
    private $title;
    /**
     * 被操作人员工userid
     */
    private $userid;
    /**
     * webOA后台url
     */
    private $webUrl;

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setkVContent($kVContent)
    {
        $this->kVContent = $kVContent;
        $this->apiParas['k_v_content'] = $kVContent;
    }

    public function getkVContent()
    {
        return $this->kVContent;
    }

    public function setPcUrl($pcUrl)
    {
        $this->pcUrl = $pcUrl;
        $this->apiParas['pc_url'] = $pcUrl;
    }

    public function getPcUrl()
    {
        return $this->pcUrl;
    }

    public function setPhoneUrl($phoneUrl)
    {
        $this->phoneUrl = $phoneUrl;
        $this->apiParas['phone_url'] = $phoneUrl;
    }

    public function getPhoneUrl()
    {
        return $this->phoneUrl;
    }

    public function setRecordTimestamp($recordTimestamp)
    {
        $this->recordTimestamp = $recordTimestamp;
        $this->apiParas['record_timestamp'] = $recordTimestamp;
    }

    public function getRecordTimestamp()
    {
        return $this->recordTimestamp;
    }

    public function setResumeId($resumeId)
    {
        $this->resumeId = $resumeId;
        $this->apiParas['resume_id'] = $resumeId;
    }

    public function getResumeId()
    {
        return $this->resumeId;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
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

    public function setWebUrl($webUrl)
    {
        $this->webUrl = $webUrl;
        $this->apiParas['web_url'] = $webUrl;
    }

    public function getWebUrl()
    {
        return $this->webUrl;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.hrm.employee.updateresumerecord';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->resumeId, 'resumeId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
