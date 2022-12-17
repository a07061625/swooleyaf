<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.feed.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.23
 */
class FeedSyncRequest extends BaseRequest
{
    /**
     * 媒体相册id
     */
    private $albumId;
    /**
     * 部门或班级id
     */
    private $deptId;
    /**
     * 同步类型(1.全量同步，2.单个同步)
     */
    private $feeType;
    /**
     * 媒体list
     */
    private $feedMedias;
    /**
     * 拓展字段
     */
    private $future;
    /**
     * 媒体用户id
     */
    private $mediaUid;
    /**
     * 接口同步id(选填)
     */
    private $opUserId;
    /**
     * 发送时间戳(毫秒)
     */
    private $sendTime;
    /**
     * 媒体发送用户id
     */
    private $sendUid;

    public function setAlbumId($albumId)
    {
        $this->albumId = $albumId;
        $this->apiParas['album_id'] = $albumId;
    }

    public function getAlbumId()
    {
        return $this->albumId;
    }

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setFeeType($feeType)
    {
        $this->feeType = $feeType;
        $this->apiParas['fee_type'] = $feeType;
    }

    public function getFeeType()
    {
        return $this->feeType;
    }

    public function setFeedMedias($feedMedias)
    {
        $this->feedMedias = $feedMedias;
        $this->apiParas['feed_medias'] = $feedMedias;
    }

    public function getFeedMedias()
    {
        return $this->feedMedias;
    }

    public function setFuture($future)
    {
        $this->future = $future;
        $this->apiParas['future'] = $future;
    }

    public function getFuture()
    {
        return $this->future;
    }

    public function setMediaUid($mediaUid)
    {
        $this->mediaUid = $mediaUid;
        $this->apiParas['media_uid'] = $mediaUid;
    }

    public function getMediaUid()
    {
        return $this->mediaUid;
    }

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_userId'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;
        $this->apiParas['send_time'] = $sendTime;
    }

    public function getSendTime()
    {
        return $this->sendTime;
    }

    public function setSendUid($sendUid)
    {
        $this->sendUid = $sendUid;
        $this->apiParas['send_uid'] = $sendUid;
    }

    public function getSendUid()
    {
        return $this->sendUid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.feed.sync';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->feeType, 'feeType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
