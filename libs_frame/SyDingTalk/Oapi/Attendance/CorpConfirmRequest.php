<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.corp.confirm request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class CorpConfirmRequest extends BaseRequest
{
    /**
     * 企业id
     */
    private $corpId;
    /**
     * 企业明细
     */
    private $corpList;

    public function setCorpId($corpId)
    {
        $this->corpId = $corpId;
        $this->apiParas['corp_id'] = $corpId;
    }

    public function getCorpId()
    {
        return $this->corpId;
    }

    public function setCorpList($corpList)
    {
        $this->corpList = $corpList;
        $this->apiParas['corp_list'] = $corpList;
    }

    public function getCorpList()
    {
        return $this->corpList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.corp.confirm';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->corpId, 'corpId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
