<?php

namespace SyDingTalk\Oapi\WorkRecord;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workrecord.add request
 *
 * @author auto create
 *
 * @since 1.0, 2022.03.24
 */
class AddRequest extends BaseRequest
{
    /**
     * 外部业务id，建议带上业务方来源字段，防止与其他业务方冲突
     */
    private $bizId;
    /**
     * 待办时间。Unix时间戳
     */
    private $createTime;
    /**
     * 表单列表
     */
    private $formItemList;
    /**
     * 发起人id
     */
    private $originatorUserId;
    /**
     * pc端跳转url，不传则使用url参数
     */
    private $pcUrl;
    /**
     * 待办的pc打开方式。2表示在pc端打开，4表示在浏览器打开
     */
    private $pcOpenType;
    /**
     * 待办来源名称
     */
    private $sourceName;
    /**
     * 标题
     */
    private $title;
    /**
     * 待办跳转url
     */
    private $url;
    /**
     * 用户id
     */
    private $userid;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
        $this->apiParas['create_time'] = $createTime;
    }

    public function getCreateTime()
    {
        return $this->createTime;
    }

    public function setFormItemList($formItemList)
    {
        $this->formItemList = $formItemList;
        $this->apiParas['formItemList'] = $formItemList;
    }

    public function getFormItemList()
    {
        return $this->formItemList;
    }

    public function setOriginatorUserId($originatorUserId)
    {
        $this->originatorUserId = $originatorUserId;
        $this->apiParas['originator_user_id'] = $originatorUserId;
    }

    public function getOriginatorUserId()
    {
        return $this->originatorUserId;
    }

    public function setPcUrl($pcUrl)
    {
        $this->pcUrl = $pcUrl;
        $this->apiParas['pcUrl'] = $pcUrl;
    }

    public function getPcUrl()
    {
        return $this->pcUrl;
    }

    public function setPcOpenType($pcOpenType)
    {
        $this->pcOpenType = $pcOpenType;
        $this->apiParas['pc_open_type'] = $pcOpenType;
    }

    public function getPcOpenType()
    {
        return $this->pcOpenType;
    }

    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;
        $this->apiParas['source_name'] = $sourceName;
    }

    public function getSourceName()
    {
        return $this->sourceName;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workrecord.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->createTime, 'createTime');
        RequestCheckUtil::checkNotNull($this->title, 'title');
        RequestCheckUtil::checkNotNull($this->url, 'url');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
