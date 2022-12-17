<?php

namespace SyDingTalk\Oapi\CallBack;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.callback.failrecord.confirm request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FailRecordConfirmRequest extends BaseRequest
{
    /**
     * 失败记录id列表
     */
    private $idList;

    public function setIdList($idList)
    {
        $this->idList = $idList;
        $this->apiParas['id_list'] = $idList;
    }

    public function getIdList()
    {
        return $this->idList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.callback.failrecord.confirm';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->idList, 'idList');
        RequestCheckUtil::checkMaxListSize($this->idList, 100, 'idList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
