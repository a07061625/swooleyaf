<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.faceVerification.init request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.26
 */
class FaceVerificationInitRequest extends BaseRequest
{
    /**
     * 生物信息（通过jsapi获取）
     */
    private $bioInfo;
    /**
     * 证件姓名
     */
    private $certName;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 业务场景
     */
    private $scene;
    /**
     * 手机号
     */
    private $userMobile;

    public function setBioInfo($bioInfo)
    {
        $this->bioInfo = $bioInfo;
        $this->apiParas['bio_info'] = $bioInfo;
    }

    public function getBioInfo()
    {
        return $this->bioInfo;
    }

    public function setCertName($certName)
    {
        $this->certName = $certName;
        $this->apiParas['cert_name'] = $certName;
    }

    public function getCertName()
    {
        return $this->certName;
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

    public function setScene($scene)
    {
        $this->scene = $scene;
        $this->apiParas['scene'] = $scene;
    }

    public function getScene()
    {
        return $this->scene;
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
        return 'dingtalk.oapi.finance.faceVerification.init';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bioInfo, 'bioInfo');
        RequestCheckUtil::checkNotNull($this->certName, 'certName');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->scene, 'scene');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
