<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.contact.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.16
 */
class ObjectDataContactListRequest extends BaseRequest
{
    /**
     * 操作人用户ID
     */
    private $currentOperatorUserid;
    /**
     * 数据ID列表
     */
    private $dataIdList;
    /**
     * 自建应用时传入定制服务商ID
     */
    private $providerCorpid;

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

    public function setProviderCorpid($providerCorpid)
    {
        $this->providerCorpid = $providerCorpid;
        $this->apiParas['provider_corpid'] = $providerCorpid;
    }

    public function getProviderCorpid()
    {
        return $this->providerCorpid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectdata.contact.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->dataIdList, 'dataIdList');
        RequestCheckUtil::checkMaxListSize($this->dataIdList, 100, 'dataIdList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
