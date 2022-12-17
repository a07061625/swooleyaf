<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.cooperation.carrier.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.04
 */
class CooperationCarrierGetRequest extends BaseRequest
{
    /**
     * 载具id
     */
    private $carrierId;
    /**
     * 租户id
     */
    private $tenantId;
    /**
     * 业务参数[这里先预留],这里是用户ID,比如钉钉用户ID
     */
    private $userid;

    public function setCarrierId($carrierId)
    {
        $this->carrierId = $carrierId;
        $this->apiParas['carrier_id'] = $carrierId;
    }

    public function getCarrierId()
    {
        return $this->carrierId;
    }

    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
        $this->apiParas['tenant_id'] = $tenantId;
    }

    public function getTenantId()
    {
        return $this->tenantId;
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
        return 'dingtalk.oapi.rhino.cooperation.carrier.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
