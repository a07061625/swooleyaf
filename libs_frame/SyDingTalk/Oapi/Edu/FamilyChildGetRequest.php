<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.family.child.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.20
 */
class FamilyChildGetRequest extends BaseRequest
{
    /**
     * 孩子userid
     */
    private $childUserid;
    /**
     * 操作者userid
     */
    private $opUserid;

    public function setChildUserid($childUserid)
    {
        $this->childUserid = $childUserid;
        $this->apiParas['child_userid'] = $childUserid;
    }

    public function getChildUserid()
    {
        return $this->childUserid;
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
        return 'dingtalk.oapi.edu.family.child.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->childUserid, 'childUserid');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
