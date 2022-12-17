<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.project.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.30
 */
class BtripProjectDeleteRequest extends BaseRequest
{
    /**
     * 企业id
     */
    private $corpid;
    /**
     * 第三方项目ID
     */
    private $thirdPartId;

    public function setCorpid($corpid)
    {
        $this->corpid = $corpid;
        $this->apiParas['corpid'] = $corpid;
    }

    public function getCorpid()
    {
        return $this->corpid;
    }

    public function setThirdPartId($thirdPartId)
    {
        $this->thirdPartId = $thirdPartId;
        $this->apiParas['third_part_id'] = $thirdPartId;
    }

    public function getThirdPartId()
    {
        return $this->thirdPartId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.alitrip.btrip.project.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->corpid, 'corpid');
        RequestCheckUtil::checkNotNull($this->thirdPartId, 'thirdPartId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
