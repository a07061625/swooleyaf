<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.detaildata.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.26
 */
class CourseDetaildataListRequest extends BaseRequest
{
    /**
     * 数据类别编码
     */
    private $categoryCode;
    /**
     * 课程编码
     */
    private $courseCode;
    /**
     * 分页游标，从0开始
     */
    private $cursor;
    /**
     * 数据因子编码数组，不填的话自动填充类别下全部的明细因子
     */
    private $factorCodes;
    /**
     * 当前操作人的用户ID
     */
    private $opUserid;
    /**
     * 分页大小
     */
    private $size;
    /**
     * 需要获取的用户CropId（必须和用户ID同时传值或同时为空）
     */
    private $userCropid;
    /**
     * 需要获取的用户ID
     */
    private $userIds;

    public function setCategoryCode($categoryCode)
    {
        $this->categoryCode = $categoryCode;
        $this->apiParas['category_code'] = $categoryCode;
    }

    public function getCategoryCode()
    {
        return $this->categoryCode;
    }

    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
        $this->apiParas['course_code'] = $courseCode;
    }

    public function getCourseCode()
    {
        return $this->courseCode;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setFactorCodes($factorCodes)
    {
        $this->factorCodes = $factorCodes;
        $this->apiParas['factor_codes'] = $factorCodes;
    }

    public function getFactorCodes()
    {
        return $this->factorCodes;
    }

    public function setOpUserid($opUserid)
    {
        $this->opUserid = $opUserid;
        $this->apiParas['op_userid'] = $opUserid;
    }

    public function getOpUserid()
    {
        return $this->opUserid;
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

    public function setUserCropid($userCropid)
    {
        $this->userCropid = $userCropid;
        $this->apiParas['user_cropid'] = $userCropid;
    }

    public function getUserCropid()
    {
        return $this->userCropid;
    }

    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        $this->apiParas['user_ids'] = $userIds;
    }

    public function getUserIds()
    {
        return $this->userIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.detaildata.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->categoryCode, 'categoryCode');
        RequestCheckUtil::checkNotNull($this->courseCode, 'courseCode');
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkMinValue($this->cursor, 0, 'cursor');
        RequestCheckUtil::checkMaxListSize($this->factorCodes, 100, 'factorCodes');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 100, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
        RequestCheckUtil::checkMaxListSize($this->userIds, 100, 'userIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
