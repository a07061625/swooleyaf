<?php

namespace SyDingTalk\Corp\Hrm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.hrm.employee.setuserworkdata request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class EmployeeSetUserWorkDataRequest extends BaseRequest
{
    /**
     * 员工信息对象，被操作人userid是必填
     */
    private $hrmApiUserDataModel;
    /**
     * 操作人userid，必须是拥有被操作人操作权限的管理员userid
     */
    private $opUserid;

    public function setHrmApiUserDataModel($hrmApiUserDataModel)
    {
        $this->hrmApiUserDataModel = $hrmApiUserDataModel;
        $this->apiParas['hrm_api_user_data_model'] = $hrmApiUserDataModel;
    }

    public function getHrmApiUserDataModel()
    {
        return $this->hrmApiUserDataModel;
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
        return 'dingtalk.corp.hrm.employee.setuserworkdata';
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
