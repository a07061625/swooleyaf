<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.user.senior.setting request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.07
 */
class SeniorSettingRequest extends BaseRequest
{
    /**
     * 高管模式是否开启
     */
    private $open;
    /**
     * 高管联系人白名单
     */
    private $permitStaffIds;
    /**
     * 高管保护开关，例如DING_SMS，保护高管不受短信DING打扰
     */
    private $protectScenes;
    /**
     * 高管工号
     */
    private $seniorStaffId;

    public function setOpen($open)
    {
        $this->open = $open;
        $this->apiParas['open'] = $open;
    }

    public function getOpen()
    {
        return $this->open;
    }

    public function setPermitStaffIds($permitStaffIds)
    {
        $this->permitStaffIds = $permitStaffIds;
        $this->apiParas['permit_staffIds'] = $permitStaffIds;
    }

    public function getPermitStaffIds()
    {
        return $this->permitStaffIds;
    }

    public function setProtectScenes($protectScenes)
    {
        $this->protectScenes = $protectScenes;
        $this->apiParas['protect_scenes'] = $protectScenes;
    }

    public function getProtectScenes()
    {
        return $this->protectScenes;
    }

    public function setSeniorStaffId($seniorStaffId)
    {
        $this->seniorStaffId = $seniorStaffId;
        $this->apiParas['senior_staffId'] = $seniorStaffId;
    }

    public function getSeniorStaffId()
    {
        return $this->seniorStaffId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.senior.setting';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->permitStaffIds, 999, 'permitStaffIds');
        RequestCheckUtil::checkMaxListSize($this->protectScenes, 999, 'protectScenes');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
