<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.record.upload request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.04
 */
class RecordUploadRequest extends BaseRequest
{
    /**
     * 设备唯一标识
     */
    private $deviceId;
    /**
     * 打卡设备名称
     */
    private $deviceName;
    /**
     * 打卡备注图片地址，必须是公网可访问的地址
     */
    private $photoUrl;
    /**
     * 员工打卡的时间
     */
    private $userCheckTime;
    /**
     * 员工id
     */
    private $userid;

    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->apiParas['device_id'] = $deviceId;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
        $this->apiParas['device_name'] = $deviceName;
    }

    public function getDeviceName()
    {
        return $this->deviceName;
    }

    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;
        $this->apiParas['photo_url'] = $photoUrl;
    }

    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    public function setUserCheckTime($userCheckTime)
    {
        $this->userCheckTime = $userCheckTime;
        $this->apiParas['user_check_time'] = $userCheckTime;
    }

    public function getUserCheckTime()
    {
        return $this->userCheckTime;
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
        return 'dingtalk.oapi.attendance.record.upload';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deviceId, 'deviceId');
        RequestCheckUtil::checkNotNull($this->deviceName, 'deviceName');
        RequestCheckUtil::checkNotNull($this->userCheckTime, 'userCheckTime');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
