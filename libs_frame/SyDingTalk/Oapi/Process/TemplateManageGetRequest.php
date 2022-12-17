<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.template.manage.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.12.14
 */
class TemplateManageGetRequest extends BaseRequest
{
    /**
     * 应用id
     */
    private $appUuid;
    /**
     * 用户id
     */
    private $userid;

    public function setAppUuid($appUuid)
    {
        $this->appUuid = $appUuid;
        $this->apiParas['app_uuid'] = $appUuid;
    }

    public function getAppUuid()
    {
        return $this->appUuid;
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
        return 'dingtalk.oapi.process.template.manage.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
