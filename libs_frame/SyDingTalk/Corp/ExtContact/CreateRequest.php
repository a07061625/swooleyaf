<?php

namespace SyDingTalk\Corp\ExtContact;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.extcontact.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class CreateRequest extends BaseRequest
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
        return 'dingtalk.corp.extcontact.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
