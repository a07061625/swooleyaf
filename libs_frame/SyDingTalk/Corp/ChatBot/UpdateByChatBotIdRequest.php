<?php

namespace SyDingTalk\Corp\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.chatbot.updatebychatbotid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class UpdateByChatBotIdRequest extends BaseRequest
{
    /**
     * 机器人简单描述
     */
    private $breif;
    /**
     * 机器人id(钉钉分配)
     */
    private $chatbotId;
    /**
     * 机器人详细描述
     */
    private $description;
    /**
     * 机器人头像
     */
    private $icon;
    /**
     * 机器人名字
     */
    private $name;
    /**
     * 机器人预览图
     */
    private $previewMediaId;
    /**
     * 更新名字或头像时是否更新群里已添加机器人的名字或头像。         * 0-不更新群里机器人名字或头像         * 1-更新群里机器人名字或头像
     */
    private $updateType;

    public function setBreif($breif)
    {
        $this->breif = $breif;
        $this->apiParas['breif'] = $breif;
    }

    public function getBreif()
    {
        return $this->breif;
    }

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->apiParas['description'] = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        $this->apiParas['icon'] = $icon;
    }

    public function getIcon()
    {
        return $this->icon;
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

    public function setPreviewMediaId($previewMediaId)
    {
        $this->previewMediaId = $previewMediaId;
        $this->apiParas['preview_media_id'] = $previewMediaId;
    }

    public function getPreviewMediaId()
    {
        return $this->previewMediaId;
    }

    public function setUpdateType($updateType)
    {
        $this->updateType = $updateType;
        $this->apiParas['update_type'] = $updateType;
    }

    public function getUpdateType()
    {
        return $this->updateType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.chatbot.updatebychatbotid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->updateType, 'updateType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
