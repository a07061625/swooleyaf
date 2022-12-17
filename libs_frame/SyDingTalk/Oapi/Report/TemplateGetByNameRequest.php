<?php

namespace SyDingTalk\Oapi\Report;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.report.template.getbyname request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.16
 */
class TemplateGetByNameRequest extends BaseRequest
{
    /**
     * 模板名称
     */
    private $templateName;
    /**
     * 员工id
     */
    private $userid;

    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
        $this->apiParas['template_name'] = $templateName;
    }

    public function getTemplateName()
    {
        return $this->templateName;
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
        return 'dingtalk.oapi.report.template.getbyname';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->templateName, 'templateName');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
