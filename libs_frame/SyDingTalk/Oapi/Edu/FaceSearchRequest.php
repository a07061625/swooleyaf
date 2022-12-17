<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.face.search request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.09
 */
class FaceSearchRequest extends BaseRequest
{
    /**
     * 班级id
     */
    private $classId;
    /**
     * 图片宽度，同步调用时候必须
     */
    private $height;
    /**
     * 是否同步调用，默认不同步
     */
    private $synchronous;
    /**
     * https://img.alicdn.com/tfs/TB1._LRfUz1gK0jSZLeXXb9kVXa-36-32.png
     */
    private $url;
    /**
     * 用户id
     */
    private $userid;
    /**
     * 图片宽度，同步调用时候必须
     */
    private $width;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setHeight($height)
    {
        $this->height = $height;
        $this->apiParas['height'] = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setSynchronous($synchronous)
    {
        $this->synchronous = $synchronous;
        $this->apiParas['synchronous'] = $synchronous;
    }

    public function getSynchronous()
    {
        return $this->synchronous;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->apiParas['url'] = $url;
    }

    public function getUrl()
    {
        return $this->url;
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

    public function setWidth($width)
    {
        $this->width = $width;
        $this->apiParas['width'] = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.face.search';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->url, 'url');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
