<?php

namespace SyDingTalk\Oapi\Workbench;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workbench.shortcut.add request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.24
 */
class ShortcutAddRequest extends BaseRequest
{
    /**
     * 微应用ID
     */
    private $appId;
    /**
     * 系统交互唯一业务号,ISV企业下唯一
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
     * 移动端快捷方式跳转地址(默认地址)
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
        return 'dingtalk.oapi.workbench.shortcut.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appId, 'appId');
        RequestCheckUtil::checkNotNull($this->bizNo, 'bizNo');
        RequestCheckUtil::checkNotNull($this->icon, 'icon');
        RequestCheckUtil::checkNotNull($this->name, 'name');
        RequestCheckUtil::checkNotNull($this->shortcutUri, 'shortcutUri');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
