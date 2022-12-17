<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.hasface request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.28
 */
class HasFaceRequest extends BaseRequest
{
    /**
     * 查询用userid列表
     */
    private $useridList;

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.hasface';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 100, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
