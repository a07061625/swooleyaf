<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.recommend.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.21
 */
class RecommendCreateRequest extends BaseRequest
{
    /**
     * 班级ID
     */
    private $classId;
    /**
     * 内容标签，推荐扩散给其他用户使用
     */
    private $labelList;
    /**
     * ISV侧内容唯一ID
     */
    private $outContentId;
    /**
     * 学段
     */
    private $periodCode;
    /**
     * 回跳地址
     */
    private $returnUrl;
    /**
     * 学科
     */
    private $subjectCode;
    /**
     * 摘要
     */
    private $summary;
    /**
     * 教材版本
     */
    private $textbookCode;
    /**
     * 缩略图url地址
     */
    private $thumbnail;
    /**
     * 内容标题
     */
    private $title;
    /**
     * 内容总时长，单位秒
     */
    private $totalTime;
    /**
     * 类型：1词汇 2课文 3题目 4考试 5知识点 6课程 7其他
     */
    private $type;
    /**
     * 当前用户userid
     */
    private $userid;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setLabelList($labelList)
    {
        $this->labelList = $labelList;
        $this->apiParas['labelList'] = $labelList;
    }

    public function getLabelList()
    {
        return $this->labelList;
    }

    public function setOutContentId($outContentId)
    {
        $this->outContentId = $outContentId;
        $this->apiParas['out_content_id'] = $outContentId;
    }

    public function getOutContentId()
    {
        return $this->outContentId;
    }

    public function setPeriodCode($periodCode)
    {
        $this->periodCode = $periodCode;
        $this->apiParas['period_code'] = $periodCode;
    }

    public function getPeriodCode()
    {
        return $this->periodCode;
    }

    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
        $this->apiParas['return_url'] = $returnUrl;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function setSubjectCode($subjectCode)
    {
        $this->subjectCode = $subjectCode;
        $this->apiParas['subject_code'] = $subjectCode;
    }

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
        $this->apiParas['summary'] = $summary;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setTextbookCode($textbookCode)
    {
        $this->textbookCode = $textbookCode;
        $this->apiParas['textbook_code'] = $textbookCode;
    }

    public function getTextbookCode()
    {
        return $this->textbookCode;
    }

    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
        $this->apiParas['thumbnail'] = $thumbnail;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
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

    public function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
        $this->apiParas['totalTime'] = $totalTime;
    }

    public function getTotalTime()
    {
        return $this->totalTime;
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
        return 'dingtalk.oapi.edu.recommend.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->labelList, 100, 'labelList');
        RequestCheckUtil::checkNotNull($this->outContentId, 'outContentId');
        RequestCheckUtil::checkNotNull($this->periodCode, 'periodCode');
        RequestCheckUtil::checkNotNull($this->returnUrl, 'returnUrl');
        RequestCheckUtil::checkNotNull($this->thumbnail, 'thumbnail');
        RequestCheckUtil::checkNotNull($this->title, 'title');
        RequestCheckUtil::checkNotNull($this->type, 'type');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
