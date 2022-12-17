<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sns.send_msg request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class SendMsgRequest extends BaseRequest
{
    /**
     * form表单提交成功后获取的formId
     */
    private $code;
    /**
     * 消息内容
     */
    private $msg;

    public function setCode($code)
    {
        $this->code = $code;
        $this->apiParas['code'] = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
        $this->apiParas['msg'] = $msg;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sns.send_msg';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
