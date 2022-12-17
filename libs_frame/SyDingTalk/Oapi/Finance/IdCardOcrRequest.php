<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.finance.IdCard.ocr request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.28
 */
class IdCardOcrRequest extends BaseRequest
{
    /**
     * 身份证反面照片地址
     */
    private $backPictureUrl;
    /**
     * 身份证正面照片地址
     */
    private $frontPictureUrl;
    /**
     * 身份证号
     */
    private $idCardNo;
    /**
     * 请求标识（保证唯一）
     */
    private $requestId;
    /**
     * 手机号
     */
    private $userMobile;

    public function setBackPictureUrl($backPictureUrl)
    {
        $this->backPictureUrl = $backPictureUrl;
        $this->apiParas['back_picture_url'] = $backPictureUrl;
    }

    public function getBackPictureUrl()
    {
        return $this->backPictureUrl;
    }

    public function setFrontPictureUrl($frontPictureUrl)
    {
        $this->frontPictureUrl = $frontPictureUrl;
        $this->apiParas['front_picture_url'] = $frontPictureUrl;
    }

    public function getFrontPictureUrl()
    {
        return $this->frontPictureUrl;
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

    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        $this->apiParas['request_id'] = $requestId;
    }

    public function getRequestId()
    {
        return $this->requestId;
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
        return 'dingtalk.oapi.finance.IdCard.ocr';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->backPictureUrl, 'backPictureUrl');
        RequestCheckUtil::checkNotNull($this->frontPictureUrl, 'frontPictureUrl');
        RequestCheckUtil::checkNotNull($this->idCardNo, 'idCardNo');
        RequestCheckUtil::checkNotNull($this->requestId, 'requestId');
        RequestCheckUtil::checkNotNull($this->userMobile, 'userMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
