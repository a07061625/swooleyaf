<?php

namespace SyDingTalk\Oapi\Medal;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.medal.corpmedal.remove request
 *
 * @author auto create
 *
 * @since 1.0, 2019.11.19
 */
class CorpMedalRemoveRequest extends BaseRequest
{
    /**
     * 勋章模板ID
     */
    private $templateId;
    /**
     * 员工ID
     */
    private $userid;

    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        $this->apiParas['template_id'] = $templateId;
    }

    public function getTemplateId()
    {
        return $this->templateId;
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
        return 'dingtalk.oapi.medal.corpmedal.remove';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->templateId, 'templateId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
