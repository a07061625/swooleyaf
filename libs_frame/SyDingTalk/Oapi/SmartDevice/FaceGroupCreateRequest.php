<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.facegroup.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FaceGroupCreateRequest extends BaseRequest
{
    /**
     * M2上的定制UI
     */
    private $bgImgUrl;
    /**
     * 业务id【不区分大小写】：调用方内保证唯一即可，可容纳23个字符，推荐前三个字符表示业务编号，留19个字符存储业务的记录id
     */
    private $bizId;
    /**
     * 结束时间
     */
    private $endTime;
    /**
     * 识别成功后的问候语
     */
    private $greetingMsg;
    /**
     * 开始时间
     */
    private $startTime;
    /**
     * 识别组启用状态：1-已启用；2未启用；
     */
    private $status;
    /**
     * 识别组的标题
     */
    private $title;

    public function setBgImgUrl($bgImgUrl)
    {
        $this->bgImgUrl = $bgImgUrl;
        $this->apiParas['bg_img_url'] = $bgImgUrl;
    }

    public function getBgImgUrl()
    {
        return $this->bgImgUrl;
    }

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->apiParas['end_time'] = $endTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setGreetingMsg($greetingMsg)
    {
        $this->greetingMsg = $greetingMsg;
        $this->apiParas['greeting_msg'] = $greetingMsg;
    }

    public function getGreetingMsg()
    {
        return $this->greetingMsg;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->apiParas['start_time'] = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.facegroup.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxLength($this->bgImgUrl, 512, 'bgImgUrl');
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkMaxLength($this->bizId, 23, 'bizId');
        RequestCheckUtil::checkNotNull($this->endTime, 'endTime');
        RequestCheckUtil::checkMaxLength($this->greetingMsg, 16, 'greetingMsg');
        RequestCheckUtil::checkNotNull($this->startTime, 'startTime');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkMaxValue($this->status, 2, 'status');
        RequestCheckUtil::checkMinValue($this->status, 1, 'status');
        RequestCheckUtil::checkNotNull($this->title, 'title');
        RequestCheckUtil::checkMaxLength($this->title, 32, 'title');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
