<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.facegroup.member.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FaceGroupMemberUpdateRequest extends BaseRequest
{
    /**
     * 需新增的用户id列表
     */
    private $addUserIds;
    /**
     * 业务id
     */
    private $bizId;
    /**
     * 需移除的用户id列表
     */
    private $delUserIds;

    public function setAddUserIds($addUserIds)
    {
        $this->addUserIds = $addUserIds;
        $this->apiParas['add_user_ids'] = $addUserIds;
    }

    public function getAddUserIds()
    {
        return $this->addUserIds;
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

    public function setDelUserIds($delUserIds)
    {
        $this->delUserIds = $delUserIds;
        $this->apiParas['del_user_ids'] = $delUserIds;
    }

    public function getDelUserIds()
    {
        return $this->delUserIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.facegroup.member.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->addUserIds, 100, 'addUserIds');
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkMaxLength($this->bizId, 23, 'bizId');
        RequestCheckUtil::checkMaxListSize($this->delUserIds, 100, 'delUserIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
