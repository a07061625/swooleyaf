<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workspace.project.create.v2 request
 *
 * @author auto create
 *
 * @since 1.0, 2022.01.19
 */
class ProjectCreateV2Request extends BaseRequest
{
    /**
     * 项目创建人userid
     */
    private $belongCorpUserid;
    /**
     * 是否创建群
     */
    private $createGroup;
    /**
     * 描述，长度256字符以内
     */
    private $desc;
    /**
     * 项目logo media id
     */
    private $logoMediaId;
    /**
     * 组织名，长度3-50个字符以内，不允许中划线、下划线、逗号、空格
     */
    private $name;
    /**
     * 群ID
     */
    private $openConversationId;
    /**
     * sourceid
     */
    private $outerId;
    /**
     * 默认创建项目，可不用入参
     */
    private $type;

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

    public function setLogoMediaId($logoMediaId)
    {
        $this->logoMediaId = $logoMediaId;
        $this->apiParas['logo_media_id'] = $logoMediaId;
    }

    public function getLogoMediaId()
    {
        return $this->logoMediaId;
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

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.project.create.v2';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->name, 'name');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
