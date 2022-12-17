<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.visitor.removevisitor request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class VisitorRemoveVisitorRequest extends BaseRequest
{
    /**
     * 预约编号
     */
    private $reservationId;

    public function setReservationId($reservationId)
    {
        $this->reservationId = $reservationId;
        $this->apiParas['reservation_id'] = $reservationId;
    }

    public function getReservationId()
    {
        return $this->reservationId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.visitor.removevisitor';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->reservationId, 'reservationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
