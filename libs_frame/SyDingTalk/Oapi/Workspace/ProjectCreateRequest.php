<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workspace.project.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.09
 */
class ProjectCreateRequest extends BaseRequest
{
    /**
     * 创建人（主管理员）在归属组织内的userId
     */
    private $belongCorpUserid;
    /**
     * 是否建圈自动建群
     */
    private $createGroup;
    /**
     * 描述，长度256字符以内
     */
    private $desc;
    /**
     * 组织名，长度3-50个字符以内，不允许中划线、下划线、逗号、空格
     */
    private $name;
    /**
     * 开放的cid，如果有值会把该群作为组织的默认群，否则会新创建1个默认群
     */
    private $openConversationId;
    /**
     * 允许调用者传入外部id用于做系统关联
     */
    private $outerId;
    /**
     * 模板id
     */
    private $templateId;
    /**
     * 1项目组织  2圈子组织
     */
    private $type;
    /**
     * 可以指定创建人在项目/圈子组织内的userId，如果不填系统随机生成
     */
    private $userid;

    public function setBelongCorpUserid($belongCorpUserid)
    {
        $this->belongCorpUserid = $belongCorpUserid;
        $this->apiParas['belong_corp_userid'] = $belongCorpUserid;
    }

    public function getBelongCorpUserid()
    {
        return $this->belongCorpUserid;
    }

    public function setCreateGroup($createGroup)
    {
        $this->createGroup = $createGroup;
        $this->apiParas['create_group'] = $createGroup;
    }

    public function getCreateGroup()
    {
        return $this->createGroup;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
        $this->apiParas['desc'] = $desc;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setOuterId($outerId)
    {
        $this->outerId = $outerId;
        $this->apiParas['outer_id'] = $outerId;
    }

    public function getOuterId()
    {
        return $this->outerId;
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

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
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
        return 'dingtalk.oapi.workspace.project.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->belongCorpUserid, 'belongCorpUserid');
        RequestCheckUtil::checkNotNull($this->name, 'name');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
