<?php

namespace SyDingTalk\Oapi\Collection;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.collection.instance.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.16
 */
class InstanceListRequest extends BaseRequest
{
    /**
     * 时间，必须是YYYY-MM-DD的格式
     */
    private $actionDate;
    /**
     * 填表类型
     */
    private $bizType;
    /**
     * 填表code
     */
    private $formCode;
    /**
     * 分页起始
     */
    private $offset;
    /**
     * 分页大小，最大100
     */
    private $size;

    public function setActionDate($actionDate)
    {
        $this->actionDate = $actionDate;
        $this->apiParas['action_date'] = $actionDate;
    }

    public function getActionDate()
    {
        return $this->actionDate;
    }

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function setFormCode($formCode)
    {
        $this->formCode = $formCode;
        $this->apiParas['form_code'] = $formCode;
    }

    public function getFormCode()
    {
        return $this->formCode;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.collection.instance.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->formCode, 'formCode');
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
