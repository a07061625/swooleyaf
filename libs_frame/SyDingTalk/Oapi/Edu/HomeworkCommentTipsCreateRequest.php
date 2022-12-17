<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.comment.tips.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.03
 */
class HomeworkCommentTipsCreateRequest extends BaseRequest
{
    /**
     * 属性字段
     */
    private $attributes;
    /**
     * 音频
     */
    private $audio;
    /**
     * sfadf
     */
    private $bizCode;
    /**
     * 内容
     */
    private $content;
    /**
     * 视频
     */
    private $media;
    /**
     * 图片
     */
    private $photo;
    /**
     * 排序
     */
    private $sortOrder;
    /**
     * 用户userid
     */
    private $userid;

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        $this->apiParas['attributes'] = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAudio($audio)
    {
        $this->audio = $audio;
        $this->apiParas['audio'] = $audio;
    }

    public function getAudio()
    {
        return $this->audio;
    }

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setMedia($media)
    {
        $this->media = $media;
        $this->apiParas['media'] = $media;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
        $this->apiParas['photo'] = $photo;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        $this->apiParas['sort_order'] = $sortOrder;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.comment.tips.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
