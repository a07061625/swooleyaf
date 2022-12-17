<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.recommend.return request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.21
 */
class RecommendReturnRequest extends BaseRequest
{
    /**
     * 班级ID 家庭场景取孩子的班级ID
     */
    private $classId;
    /**
     * 内容标签，推荐扩散给其他用户使用
     */
    private $labelList;
    /**
     * 用户学习时长，单位秒
     */
    private $learnTime;
    /**
     * ISV侧内容唯一ID
     */
    private $outContentId;
    /**
     * 外部提交ID 唯一
     */
    private $outTxId;
    /**
     * 结果分值类型 1 对错 2 百分打分 3百分比打分 4 数值
     */
    private $resultType;
    /**
     * 结果分值
     */
    private $resultValue;
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
     * 缩略图
     */
    private $thumbnail;
    /**
     * 标题
     */
    private $title;
    /**
     * 内容总时长，单位秒
     */
    private $totalTime;
    /**
     * 类型 1词汇 2课文 3题目 4考试 5知识点 6课程 7其他
     */
    private $type;
    /**
     * 传入的学习孩子userid
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

    public function setLearnTime($learnTime)
    {
        $this->learnTime = $learnTime;
        $this->apiParas['learnTime'] = $learnTime;
    }

    public function getLearnTime()
    {
        return $this->learnTime;
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

    public function setOutTxId($outTxId)
    {
        $this->outTxId = $outTxId;
        $this->apiParas['out_tx_id'] = $outTxId;
    }

    public function getOutTxId()
    {
        return $this->outTxId;
    }

    public function setResultType($resultType)
    {
        $this->resultType = $resultType;
        $this->apiParas['result_type'] = $resultType;
    }

    public function getResultType()
    {
        return $this->resultType;
    }

    public function setResultValue($resultValue)
    {
        $this->resultValue = $resultValue;
        $this->apiParas['result_value'] = $resultValue;
    }

    public function getResultValue()
    {
        return $this->resultValue;
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
        return 'dingtalk.oapi.edu.recommend.return';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->labelList, 100, 'labelList');
        RequestCheckUtil::checkNotNull($this->outContentId, 'outContentId');
        RequestCheckUtil::checkNotNull($this->outTxId, 'outTxId');
        RequestCheckUtil::checkNotNull($this->resultType, 'resultType');
        RequestCheckUtil::checkNotNull($this->resultValue, 'resultValue');
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
