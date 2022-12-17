<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.devicemember.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.13
 */
class DeviceMemberSyncRequest extends BaseRequest
{
    /**
     * 需新增的userIds（与del_userids必填其一）
     */
    private $addUserids;
    /**
     * 需移除的userIds（与add_userids必填其一）
     */
    private $delUserids;
    /**
     * 设备id
     */
    private $deviceId;

    public function setAddUserids($addUserids)
    {
        $this->addUserids = $addUserids;
        $this->apiParas['add_userids'] = $addUserids;
    }

    public function getAddUserids()
    {
        return $this->addUserids;
    }

    public function setDelUserids($delUserids)
    {
        $this->delUserids = $delUserids;
        $this->apiParas['del_userids'] = $delUserids;
    }

    public function getDelUserids()
    {
        return $this->delUserids;
    }

    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->apiParas['device_id'] = $deviceId;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.devicemember.sync';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->addUserids, 200, 'addUserids');
        RequestCheckUtil::checkMaxListSize($this->delUserids, 200, 'delUserids');
        RequestCheckUtil::checkNotNull($this->deviceId, 'deviceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
