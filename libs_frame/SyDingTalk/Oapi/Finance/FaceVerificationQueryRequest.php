<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.faceVerification.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.26
 */
class FaceVerificationQueryRequest extends BaseRequest
{
    /**
     * 人脸识别业务编码
     */
    private $businessId;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 人脸识别请求编码
     */
    private $requestCode;
    /**
     * 手机号
     */
    private $userMobile;

    public function setBusinessId($businessId)
    {
        $this->businessId = $businessId;
        $this->apiParas['business_id'] = $businessId;
    }

    public function getBusinessId()
    {
        return $this->businessId;
    }

    public function setIdCardNo($idCardNo)
    {
        $this->idCardNo = $idCardNo;
        $this->apiParas['id_card_no'] = $idCardNo;
    }

    public function getIdCardNo()
    {
        return $this->idCardNo;
    }

    public function setRequestCode($requestCode)
    {
        $this->requestCode = $requestCode;
        $this->apiParas['request_code'] = $requestCode;
    }

    public function getRequestCode()
    {
        return $this->requestCode;
    }

    public function setUserMobile($userMobile)
    {
        $this->userMobile = $userMobile;
        $this->apiParas['user_mobile'] = $userMobile;
    }

    public function getUserMobile()
    {
        return $this->userMobile;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.faceVerification.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->businessId, 'businessId');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->requestCode, 'requestCode');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
