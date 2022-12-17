<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.user.batchdelete request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class BatchDeleteRequest extends BaseRequest
{
    /**
     * 员工UserID列表。列表长度在1到20之间
     */
    private $useridlist;

    public function setUseridlist($useridlist)
    {
        $this->useridlist = $useridlist;
        $this->apiParas['useridlist'] = $useridlist;
    }

    public function getUseridlist()
    {
        return $this->useridlist;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.batchdelete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->useridlist, 20, 'useridlist');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
