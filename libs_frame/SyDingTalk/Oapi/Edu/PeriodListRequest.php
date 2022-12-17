<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.period.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.09
 */
class PeriodListRequest extends BaseRequest
{
    /**
     * 校区ID
     */
    private $campusId;

    public function setCampusId($campusId)
    {
        $this->campusId = $campusId;
        $this->apiParas['campus_id'] = $campusId;
    }

    public function getCampusId()
    {
        return $this->campusId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.period.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->campusId, 'campusId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
