<?php

namespace SyDingTalk\Oapi\ServiceAccount;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.serviceaccount.menu.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.05
 */
class MenuUpdateRequest extends BaseRequest
{
    /**
     * 菜单
     */
    private $menu;
    /**
     * 服务号的unionid
     */
    private $unionid;

    public function setMenu($menu)
    {
        $this->menu = $menu;
        $this->apiParas['menu'] = $menu;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function setUnionid($unionid)
    {
        $this->unionid = $unionid;
        $this->apiParas['unionid'] = $unionid;
    }

    public function getUnionid()
    {
        return $this->unionid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.serviceaccount.menu.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->unionid, 'unionid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
