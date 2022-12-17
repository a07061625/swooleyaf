<?php

namespace SyDingTalk\Oapi\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.message.corpconversation.asyncsend_v2 request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.03
 */
class CorpConversationAsyncSendV2Request extends BaseRequest
{
    /**
     * 微应用的id
     */
    private $agentId;
    /**
     * 接收者的部门id列表
     */
    private $deptIdList;
    /**
     * 是否开启id转译，默认false。仅第三方应用需要用到，企业内部应用可以忽略
     */
    private $enableIdTrans;
    /**
     * 消息体，具体见文档
     */
    private $msg;
    /**
     * 是否发送给企业全部用户
     */
    private $toAllUser;
    /**
     * 接收者的用户userid列表
     */
    private $useridList;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setDeptIdList($deptIdList)
    {
        $this->deptIdList = $deptIdList;
        $this->apiParas['dept_id_list'] = $deptIdList;
    }

    public function getDeptIdList()
    {
        return $this->deptIdList;
    }

    public function setEnableIdTrans($enableIdTrans)
    {
        $this->enableIdTrans = $enableIdTrans;
        $this->apiParas['enable_id_trans'] = $enableIdTrans;
    }

    public function getEnableIdTrans()
    {
        return $this->enableIdTrans;
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

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.message.corpconversation.asyncsend_v2';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkMaxListSize($this->deptIdList, 500, 'deptIdList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 5000, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
