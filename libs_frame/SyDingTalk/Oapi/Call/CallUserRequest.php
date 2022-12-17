<?php

namespace SyDingTalk\Oapi\Call;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.call.calluser request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class CallUserRequest extends BaseRequest
{
    /**
     * 授权isv套件企业的corpid
     */
    private $authedCorpId;
    /**
     * 授权isv套件企业的员工userid
     */
    private $authedStaffId;
    /**
     * isv套件所属企业下的员工userid
     */
    private $staffId;

    public function setAuthedCorpId($authedCorpId)
    {
        $this->authedCorpId = $authedCorpId;
        $this->apiParas['authed_corp_id'] = $authedCorpId;
    }

    public function getAuthedCorpId()
    {
        return $this->authedCorpId;
    }

    public function setAuthedStaffId($authedStaffId)
    {
        $this->authedStaffId = $authedStaffId;
        $this->apiParas['authed_staff_id'] = $authedStaffId;
    }

    public function getAuthedStaffId()
    {
        return $this->authedStaffId;
    }

    public function setStaffId($staffId)
    {
        $this->staffId = $staffId;
        $this->apiParas['staff_id'] = $staffId;
    }

    public function getStaffId()
    {
        return $this->staffId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.call.calluser';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->authedCorpId, 'authedCorpId');
        RequestCheckUtil::checkNotNull($this->authedStaffId, 'authedStaffId');
        RequestCheckUtil::checkNotNull($this->staffId, 'staffId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
