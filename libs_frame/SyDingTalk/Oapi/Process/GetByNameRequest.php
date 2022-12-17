<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.get_by_name request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.05
 */
class GetByNameRequest extends BaseRequest
{
    /**
     * 模板名称
     */
    private $name;

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
        return 'dingtalk.oapi.process.get_by_name';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->name, 'name');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
