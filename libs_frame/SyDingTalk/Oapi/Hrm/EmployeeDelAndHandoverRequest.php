<?php

namespace SyDingTalk\Oapi\Hrm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.hrm.employee.delandhandover request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.16
 */
class EmployeeDelAndHandoverRequest extends BaseRequest
{
    /**
     * 确认离职对象
     */
    private $dismissionInfoWithHandOver;
    /**
     * 操作人userid
     */
    private $opUserid;

    public function setDismissionInfoWithHandOver($dismissionInfoWithHandOver)
    {
        $this->dismissionInfoWithHandOver = $dismissionInfoWithHandOver;
        $this->apiParas['dismission_info_with_hand_over'] = $dismissionInfoWithHandOver;
    }

    public function getDismissionInfoWithHandOver()
    {
        return $this->dismissionInfoWithHandOver;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.hrm.employee.delandhandover';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
