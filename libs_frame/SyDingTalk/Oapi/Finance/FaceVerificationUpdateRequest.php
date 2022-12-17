<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.faceVerification.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.26
 */
class FaceVerificationUpdateRequest extends BaseRequest
{
    /**
     * 人脸识别业务编码，初始化返回值中获取
     */
    private $businessId;
    /**
     * 错误原因，jsapi调用返回错误原因
     */
    private $failReason;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 人脸识别请求编码，初始化返回值中获取
     */
    private $requestCode;
    /**
     * 错误码，jsapi调用返回错误码
     */
    private $resultCode;
    /**
     * 手机号
     */
    private $userMobile;
    /**
     * 校验结果
     */
    private $verifyResult;

    public function setBusinessId($businessId)
    {
        $this->businessId = $businessId;
        $this->apiParas['business_id'] = $businessId;
    }

    public function getBusinessId()
    {
        return $this->businessId;
    }

    public function setFailReason($failReason)
    {
        $this->failReason = $failReason;
        $this->apiParas['fail_reason'] = $failReason;
    }

    public function getFailReason()
    {
        return $this->failReason;
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

    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;
        $this->apiParas['result_code'] = $resultCode;
    }

    public function getResultCode()
    {
        return $this->resultCode;
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

    public function setVerifyResult($verifyResult)
    {
        $this->verifyResult = $verifyResult;
        $this->apiParas['verify_result'] = $verifyResult;
    }

    public function getVerifyResult()
    {
        return $this->verifyResult;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.faceVerification.update';
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
        RequestCheckUtil::checkNotNull($this->verifyResult, 'verifyResult');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
