<?php

namespace SyDingTalk\Oapi\Ocr;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ocr.structured.recognize request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.07
 */
class StructuredRecognizeRequest extends BaseRequest
{
    /**
     * 识别图片地址
     */
    private $imageUrl;
    /**
     * 识别图片类型, 身份证idcard，营业执照增值税发票invoice，营业执照blicense，银行卡bank_card，车牌car_no，机动车发票car_invoice，驾驶证driving_license，行驶证vehicle_license，火车票train_ticket，定额发票quota_invoice，出租车发票taxi_ticket，机票行程单air_itinerary
     */
    private $type;

    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        $this->apiParas['image_url'] = $imageUrl;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ocr.structured.recognize';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->imageUrl, 'imageUrl');
        RequestCheckUtil::checkMaxLength($this->imageUrl, 1000, 'imageUrl');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
