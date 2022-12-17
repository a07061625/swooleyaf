<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.masterdata.save request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.15
 */
class HrmMasterDataSaveRequest extends BaseRequest
{
    /**
     * 第三方业务数据结构
     */
    private $bizDataFields;
    /**
     * 唯一标识此记录的外键id
     */
    private $outerId;
    /**
     * 代表业务领域枚举值
     */
    private $scopeCode;
    /**
     * 数据代表用户唯一标识
     */
    private $userid;

    public function setBizDataFields($bizDataFields)
    {
        $this->bizDataFields = $bizDataFields;
        $this->apiParas['biz_data_fields'] = $bizDataFields;
    }

    public function getBizDataFields()
    {
        return $this->bizDataFields;
    }

    public function setOuterId($outerId)
    {
        $this->outerId = $outerId;
        $this->apiParas['outer_id'] = $outerId;
    }

    public function getOuterId()
    {
        return $this->outerId;
    }

    public function setScopeCode($scopeCode)
    {
        $this->scopeCode = $scopeCode;
        $this->apiParas['scope_code'] = $scopeCode;
    }

    public function getScopeCode()
    {
        return $this->scopeCode;
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
        return 'dingtalk.oapi.smartwork.hrm.masterdata.save';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->outerId, 'outerId');
        RequestCheckUtil::checkNotNull($this->scopeCode, 'scopeCode');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
