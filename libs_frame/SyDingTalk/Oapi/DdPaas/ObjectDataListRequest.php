<?php

namespace SyDingTalk\Oapi\DdPaas;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ddpaas.objectdata.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.28
 */
class ObjectDataListRequest extends BaseRequest
{
    /**
     * 钉钉PaaS应用ID
     */
    private $appUuid;
    /**
     * 当前操作用户ID，不填默认系统身份
     */
    private $currentOperatorUserid;
    /**
     * 表单数据实例ID列表
     */
    private $dataIdList;
    /**
     * 钉钉PaaS表单编号
     */
    private $formCode;

    public function setAppUuid($appUuid)
    {
        $this->appUuid = $appUuid;
        $this->apiParas['app_uuid'] = $appUuid;
    }

    public function getAppUuid()
    {
        return $this->appUuid;
    }

    public function setCurrentOperatorUserid($currentOperatorUserid)
    {
        $this->currentOperatorUserid = $currentOperatorUserid;
        $this->apiParas['current_operator_userid'] = $currentOperatorUserid;
    }

    public function getCurrentOperatorUserid()
    {
        return $this->currentOperatorUserid;
    }

    public function setDataIdList($dataIdList)
    {
        $this->dataIdList = $dataIdList;
        $this->apiParas['data_id_list'] = $dataIdList;
    }

    public function getDataIdList()
    {
        return $this->dataIdList;
    }

    public function setFormCode($formCode)
    {
        $this->formCode = $formCode;
        $this->apiParas['form_code'] = $formCode;
    }

    public function getFormCode()
    {
        return $this->formCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ddpaas.objectdata.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appUuid, 'appUuid');
        RequestCheckUtil::checkNotNull($this->dataIdList, 'dataIdList');
        RequestCheckUtil::checkMaxListSize($this->dataIdList, 999, 'dataIdList');
        RequestCheckUtil::checkNotNull($this->formCode, 'formCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
