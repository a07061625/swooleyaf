<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.user.auth.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.05
 */
class UserAuthGetRequest extends BaseRequest
{
    /**
     * 语言
     */
    private $language;
    /**
     * 用户id
     */
    private $userid;

    public function setLanguage($language)
    {
        $this->language = $language;
        $this->apiParas['language'] = $language;
    }

    public function getLanguage()
    {
        return $this->language;
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
        return 'dingtalk.oapi.edu.user.auth.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxLength($this->language, 6, 'language');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
        RequestCheckUtil::checkMaxLength($this->userid, 64, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
