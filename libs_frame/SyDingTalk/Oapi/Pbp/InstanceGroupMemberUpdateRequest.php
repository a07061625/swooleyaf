<?php

namespace SyDingTalk\Oapi\Pbp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.pbp.instance.group.member.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.25
 */
class InstanceGroupMemberUpdateRequest extends BaseRequest
{
    /**
     * 同步参数
     */
    private $syncParam;

    public function setSyncParam($syncParam)
    {
        $this->syncParam = $syncParam;
        $this->apiParas['sync_param'] = $syncParam;
    }

    public function getSyncParam()
    {
        return $this->syncParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.pbp.instance.group.member.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
