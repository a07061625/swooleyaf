<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.master.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.06
 */
class HrmMasterDeleteRequest extends BaseRequest
{
    /**
     * 业务数据
     */
    private $bizData;
    /**
     * 业务方id(由系统统一分配)
     */
    private $tenantid;

    public function setBizData($bizData)
    {
        $this->bizData = $bizData;
        $this->apiParas['biz_data'] = $bizData;
    }

    public function getBizData()
    {
        return $this->bizData;
    }

    public function setTenantid($tenantid)
    {
        $this->tenantid = $tenantid;
        $this->apiParas['tenantid'] = $tenantid;
    }

    public function getTenantid()
    {
        return $this->tenantid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.master.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->tenantid, 'tenantid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
