<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.10
 */
class CourseListRequest extends BaseRequest
{
    /**
     * 按课程编码列表查询
     */
    private $courseCodes;
    /**
     * 表示分页游标，从0开始
     */
    private $cursor;
    /**
     * 时间查询结束区间
     */
    private $endTime;
    /**
     * 按课程名称查询
     */
    private $name;
    /**
     * 当前操作人的用户ID
     */
    private $opUserid;
    /**
     * 查询选项
     */
    private $option;
    /**
     * 参与方查询条件
     */
    private $participantCondition;
    /**
     * 查询的场景：当前有：manage(管理视角)，lecture(授课视角)
     */
    private $scene;
    /**
     * 表示分页大小
     */
    private $size;
    /**
     * 时间查询开始区间
     */
    private $startTime;
    /**
     * 课程状态值
     */
    private $statuses;
    /**
     * 按应用唯一标识列表查询
     */
    private $suiteKeys;
    /**
     * 授课老师查询条件
     */
    private $teacherConditions;

    public function setCourseCodes($courseCodes)
    {
        $this->courseCodes = $courseCodes;
        $this->apiParas['course_codes'] = $courseCodes;
    }

    public function getCourseCodes()
    {
        return $this->courseCodes;
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

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->apiParas['end_time'] = $endTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
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

    public function setOption($option)
    {
        $this->option = $option;
        $this->apiParas['option'] = $option;
    }

    public function getOption()
    {
        return $this->option;
    }

    public function setParticipantCondition($participantCondition)
    {
        $this->participantCondition = $participantCondition;
        $this->apiParas['participant_condition'] = $participantCondition;
    }

    public function getParticipantCondition()
    {
        return $this->participantCondition;
    }

    public function setScene($scene)
    {
        $this->scene = $scene;
        $this->apiParas['scene'] = $scene;
    }

    public function getScene()
    {
        return $this->scene;
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

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->apiParas['start_time'] = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStatuses($statuses)
    {
        $this->statuses = $statuses;
        $this->apiParas['statuses'] = $statuses;
    }

    public function getStatuses()
    {
        return $this->statuses;
    }

    public function setSuiteKeys($suiteKeys)
    {
        $this->suiteKeys = $suiteKeys;
        $this->apiParas['suite_keys'] = $suiteKeys;
    }

    public function getSuiteKeys()
    {
        return $this->suiteKeys;
    }

    public function setTeacherConditions($teacherConditions)
    {
        $this->teacherConditions = $teacherConditions;
        $this->apiParas['teacher_conditions'] = $teacherConditions;
    }

    public function getTeacherConditions()
    {
        return $this->teacherConditions;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->courseCodes, 100, 'courseCodes');
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkMinValue($this->cursor, 0, 'cursor');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 100, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
        RequestCheckUtil::checkMaxListSize($this->statuses, 5, 'statuses');
        RequestCheckUtil::checkMaxListSize($this->suiteKeys, 5, 'suiteKeys');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
