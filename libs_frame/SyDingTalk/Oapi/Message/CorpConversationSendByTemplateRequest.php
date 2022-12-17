<?php

namespace SyDingTalk\Oapi\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.message.corpconversation.sendbytemplate request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.15
 */
class CorpConversationSendByTemplateRequest extends BaseRequest
{
    /**
     * 微应用的id
     */
    private $agentId;
    /**
     * 消息模板动态参数赋值数据, key和value均为字符串格式。
     */
    private $data;
    /**
     * 接收者的部门id列表
     */
    private $deptIdList;
    /**
     * 消息模板id
     */
    private $templateId;
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

    public function setData($data)
    {
        $this->data = $data;
        $this->apiParas['data'] = $data;
    }

    public function getData()
    {
        return $this->data;
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

    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        $this->apiParas['template_id'] = $templateId;
    }

    public function getTemplateId()
    {
        return $this->templateId;
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
        return 'dingtalk.oapi.message.corpconversation.sendbytemplate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkMaxListSize($this->deptIdList, 500, 'deptIdList');
        RequestCheckUtil::checkNotNull($this->templateId, 'templateId');
        RequestCheckUtil::checkMaxListSize($this->useridList, 5000, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
