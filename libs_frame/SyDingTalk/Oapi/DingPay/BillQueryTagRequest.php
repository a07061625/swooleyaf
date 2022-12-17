<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.bill.querytag request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class BillQueryTagRequest extends BaseRequest
{
    /**
     * 业务代码
     */
    private $bizCode;
    /**
     * 查询最近几天的标签
     */
    private $dayRange;
    /**
     * 标签来源应用ID
     */
    private $sourceAppId;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setDayRange($dayRange)
    {
        $this->dayRange = $dayRange;
        $this->apiParas['day_range'] = $dayRange;
    }

    public function getDayRange()
    {
        return $this->dayRange;
    }

    public function setSourceAppId($sourceAppId)
    {
        $this->sourceAppId = $sourceAppId;
        $this->apiParas['source_app_id'] = $sourceAppId;
    }

    public function getSourceAppId()
    {
        return $this->sourceAppId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.bill.querytag';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->dayRange, 'dayRange');
        RequestCheckUtil::checkNotNull($this->sourceAppId, 'sourceAppId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
