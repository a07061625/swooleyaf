<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.grade.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class GradeGetRequest extends BaseRequest
{
    /**
     * 年级ID
     */
    private $gradeId;

    public function setGradeId($gradeId)
    {
        $this->gradeId = $gradeId;
        $this->apiParas['grade_id'] = $gradeId;
    }

    public function getGradeId()
    {
        return $this->gradeId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.grade.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->gradeId, 'gradeId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
