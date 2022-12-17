<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.group.msg.send request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.22
 */
class GroupMsgSendRequest extends BaseRequest
{
    /**
     * 订购此应用的企业标识
     */
    private $agentId;
    /**
     * 发送此消息的唯一ID
     */
    private $bizId;
    /**
     * 班级id
     */
    private $classId;
    /**
     * 消息卡片图片地址。由业务对接人员提供
     */
    private $imageUrl;
    /**
     * 群中哪些人接受此消息，不填默认全部
     */
    private $receiveUseridList;
    /**
     * 根据消息模板传递待填充的内容，消息模板具体见场景说明。key/value值不能出现“:”和“,”字符，防止出现解析错误
     */
    private $replace;
    /**
     * 群发消息模板id
     */
    private $templateCode;
    /**
     * 发送消息人的员工id
     */
    private $userid;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        $this->apiParas['image_url'] = $imageUrl;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setReceiveUseridList($receiveUseridList)
    {
        $this->receiveUseridList = $receiveUseridList;
        $this->apiParas['receive_userid_list'] = $receiveUseridList;
    }

    public function getReceiveUseridList()
    {
        return $this->receiveUseridList;
    }

    public function setReplace($replace)
    {
        $this->replace = $replace;
        $this->apiParas['replace'] = $replace;
    }

    public function getReplace()
    {
        return $this->replace;
    }

    public function setTemplateCode($templateCode)
    {
        $this->templateCode = $templateCode;
        $this->apiParas['template_code'] = $templateCode;
    }

    public function getTemplateCode()
    {
        return $this->templateCode;
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
        return 'dingtalk.oapi.edu.group.msg.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkMaxListSize($this->receiveUseridList, 20, 'receiveUseridList');
        RequestCheckUtil::checkNotNull($this->templateCode, 'templateCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
