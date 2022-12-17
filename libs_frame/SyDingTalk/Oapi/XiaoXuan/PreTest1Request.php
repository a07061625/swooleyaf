<?php

namespace SyDingTalk\Oapi\XiaoXuan;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.xiaoxuan.pre.test1 request
 *
 * @author auto create
 *
 * @since 1.0, 2022.03.01
 */
class PreTest1Request extends BaseRequest
{
    /**
     * 1
     */
    private $name;
    /**
     * 1
     */
    private $systemData;

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSystemData($systemData)
    {
        $this->systemData = $systemData;
        $this->apiParas['systemData'] = $systemData;
    }

    public function getSystemData()
    {
        return $this->systemData;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.xiaoxuan.pre.test1';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
