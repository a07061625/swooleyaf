<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.contact.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.09
 */
class ObjectDataContactDeleteRequest extends BaseRequest
{
    /**
     * 联系人实例ID
     */
    private $dataId;
    /**
     * 操作人用户ID
     */
    private $operatorUserid;

    public function setDataId($dataId)
    {
        $this->dataId = $dataId;
        $this->apiParas['data_id'] = $dataId;
    }

    public function getDataId()
    {
        return $this->dataId;
    }

    public function setOperatorUserid($operatorUserid)
    {
        $this->operatorUserid = $operatorUserid;
        $this->apiParas['operator_userid'] = $operatorUserid;
    }

    public function getOperatorUserid()
    {
        return $this->operatorUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectdata.contact.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->dataId, 'dataId');
        RequestCheckUtil::checkNotNull($this->operatorUserid, 'operatorUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
