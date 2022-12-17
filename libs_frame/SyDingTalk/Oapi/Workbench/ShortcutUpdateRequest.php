<?php

namespace SyDingTalk\Oapi\Workbench;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workbench.shortcut.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ShortcutUpdateRequest extends BaseRequest
{
    /**
     * 应用ID
     */
    private $appId;
    /**
     * 系统交互唯一业务单号
     */
    private $bizNo;
    /**
     * 图标Url
     */
    private $icon;
    /**
     * 快捷方式名称
     */
    private $name;
    /**
     * PC端快捷方式跳转地址
     */
    private $pcShortcutUri;
    /**
     * 快捷方式跳转地址(移动端地址-默认地址)
     */
    private $shortcutUri;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['app_id'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setBizNo($bizNo)
    {
        $this->bizNo = $bizNo;
        $this->apiParas['biz_no'] = $bizNo;
    }

    public function getBizNo()
    {
        return $this->bizNo;
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

    public function setPcShortcutUri($pcShortcutUri)
    {
        $this->pcShortcutUri = $pcShortcutUri;
        $this->apiParas['pc_shortcut_uri'] = $pcShortcutUri;
    }

    public function getPcShortcutUri()
    {
        return $this->pcShortcutUri;
    }

    public function setShortcutUri($shortcutUri)
    {
        $this->shortcutUri = $shortcutUri;
        $this->apiParas['shortcut_uri'] = $shortcutUri;
    }

    public function getShortcutUri()
    {
        return $this->shortcutUri;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workbench.shortcut.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appId, 'appId');
        RequestCheckUtil::checkNotNull($this->bizNo, 'bizNo');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
