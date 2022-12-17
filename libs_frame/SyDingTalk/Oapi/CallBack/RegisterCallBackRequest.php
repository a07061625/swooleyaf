<?php

namespace SyDingTalk\Oapi\CallBack;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.call_back.register_call_back request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RegisterCallBackRequest extends BaseRequest
{
    /**
     * 数据加密密钥。用于回调数据的加密，长度固定为43个字符，从a-z, A-Z, 0-9共62个字符中选取,您可以随机生成，ISV(服务提供商)推荐使用注册套件时填写的EncodingAESKey
     */
    private $aesKey;
    /**
     * 需要监听的事件类型，有20种，“user_add_org”, “user_modify_org”, “user_leave_org”,“org_admin_add”, “org_admin_remove”, “org_dept_create”, “org_dept_modify”, “org_dept_remove”, “org_remove”,“label_user_change”, “label_conf_add”, “label_conf_modify”,“label_conf_del”,“org_change”, “chat_add_member”, “chat_remove_member”, “chat_quit”, “chat_update_owner”, “chat_update_title”, “chat_disband”, “chat_disband_microapp”,“check_in”,“bpms_task_change”,“bpms_instance_change”
     */
    private $callBackTag;
    /**
     * 加解密需要用到的token，ISV(服务提供商)推荐使用注册套件时填写的token，普通企业可以随机填写
     */
    private $token;
    /**
     * 接收事件回调的url
     */
    private $url;

    public function setAesKey($aesKey)
    {
        $this->aesKey = $aesKey;
        $this->apiParas['aes_key'] = $aesKey;
    }

    public function getAesKey()
    {
        return $this->aesKey;
    }

    public function setCallBackTag($callBackTag)
    {
        $this->callBackTag = $callBackTag;
        $this->apiParas['call_back_tag'] = $callBackTag;
    }

    public function getCallBackTag()
    {
        return $this->callBackTag;
    }

    public function setToken($token)
    {
        $this->token = $token;
        $this->apiParas['token'] = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->apiParas['url'] = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.call_back.register_call_back';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->callBackTag, 20, 'callBackTag');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
