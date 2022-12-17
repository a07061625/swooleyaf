<?php

namespace SyDingTalk\Oapi\SmartBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartbot.msg.push request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.19
 */
class MsgPushRequest extends BaseRequest
{
    /**
     * 接收者的会话chatid列表
     */
    private $chatIdList;
    /**
     * 消息体，具体见文档
     */
    private $msg;
    /**
     * 是否发送给企业全部用户，”true“则忽略用户列表和会话列表
     */
    private $toAllUser;
    /**
     * 接收者的用户userid列表
     */
    private $userIdList;

    public function setChatIdList($chatIdList)
    {
        $this->chatIdList = $chatIdList;
        $this->apiParas['chat_id_list'] = $chatIdList;
    }

    public function getChatIdList()
    {
        return $this->chatIdList;
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

    public function setToAllUser($toAllUser)
    {
        $this->toAllUser = $toAllUser;
        $this->apiParas['to_all_user'] = $toAllUser;
    }

    public function getToAllUser()
    {
        return $this->toAllUser;
    }

    public function setUserIdList($userIdList)
    {
        $this->userIdList = $userIdList;
        $this->apiParas['user_id_list'] = $userIdList;
    }

    public function getUserIdList()
    {
        return $this->userIdList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartbot.msg.push';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->chatIdList, 500, 'chatIdList');
        RequestCheckUtil::checkMaxListSize($this->userIdList, 5000, 'userIdList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
