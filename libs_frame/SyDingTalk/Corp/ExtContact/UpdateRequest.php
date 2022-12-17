<?php

namespace SyDingTalk\Corp\ExtContact;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.extcontact.update request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 外部联系人信息
     */
    private $contact;

    public function setContact($contact)
    {
        $this->contact = $contact;
        $this->apiParas['contact'] = $contact;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.extcontact.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
