<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.28
 */
class ObjectDataListRequest extends BaseRequest
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
     * 表单名称
     */
    private $name;

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

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectdata.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->dataIdList, 'dataIdList');
        RequestCheckUtil::checkMaxListSize($this->dataIdList, 100, 'dataIdList');
        RequestCheckUtil::checkNotNull($this->name, 'name');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
