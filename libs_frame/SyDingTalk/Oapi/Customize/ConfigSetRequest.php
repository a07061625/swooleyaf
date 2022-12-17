<?php

namespace SyDingTalk\Oapi\Customize;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.customize.config.set request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ConfigSetRequest extends BaseRequest
{
    /**
     * e应用id
     */
    private $activeId;
    /**
     * e应用
     */
    private $activeType;
    /**
     * 入口会话id，自定义的业务
     */
    private $biz;
    /**
     * 二级会话
     */
    private $ruleName;
    /**
     * 会话类型
     */
    private $type;

    public function setActiveId($activeId)
    {
        $this->activeId = $activeId;
        $this->apiParas['active_id'] = $activeId;
    }

    public function getActiveId()
    {
        return $this->activeId;
    }

    public function setActiveType($activeType)
    {
        $this->activeType = $activeType;
        $this->apiParas['active_type'] = $activeType;
    }

    public function getActiveType()
    {
        return $this->activeType;
    }

    public function setBiz($biz)
    {
        $this->biz = $biz;
        $this->apiParas['biz'] = $biz;
    }

    public function getBiz()
    {
        return $this->biz;
    }

    public function setRuleName($ruleName)
    {
        $this->ruleName = $ruleName;
        $this->apiParas['rule_name'] = $ruleName;
    }

    public function getRuleName()
    {
        return $this->ruleName;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customize.config.set';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->activeId, 'activeId');
        RequestCheckUtil::checkNotNull($this->activeType, 'activeType');
        RequestCheckUtil::checkNotNull($this->biz, 'biz');
        RequestCheckUtil::checkNotNull($this->ruleName, 'ruleName');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
