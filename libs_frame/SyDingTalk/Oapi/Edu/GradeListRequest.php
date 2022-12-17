<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.grade.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class GradeListRequest extends BaseRequest
{
    /**
     * 学段ID
     */
    private $periodId;

    public function setPeriodId($periodId)
    {
        $this->periodId = $periodId;
        $this->apiParas['period_id'] = $periodId;
    }

    public function getPeriodId()
    {
        return $this->periodId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.grade.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->periodId, 'periodId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
