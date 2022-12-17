<?php

namespace SyDingTalk\Oapi\Project;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.project.point.add request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.09
 */
class PointAddRequest extends BaseRequest
{
    /**
     * 增加积分的时间戳毫秒数，如果为空使用系统当前毫秒数
     */
    private $actionTime;
    /**
     * 规则代码（可空）,如果不为空的话，score值使用ruleCode对应的score增加分数
     */
    private $ruleCode;
    /**
     * 规则名称
     */
    private $ruleName;
    /**
     * 本次增加积分：正数表示增加/负数表示扣减
     */
    private $score;
    /**
     * 业务ID（固定值，农村积分传7001）
     */
    private $tenantId;
    /**
     * 用户id
     */
    private $userid;
    /**
     * 加积分的唯一幂等标志,建议使用UUID
     */
    private $uuid;

    public function setActionTime($actionTime)
    {
        $this->actionTime = $actionTime;
        $this->apiParas['action_time'] = $actionTime;
    }

    public function getActionTime()
    {
        return $this->actionTime;
    }

    public function setRuleCode($ruleCode)
    {
        $this->ruleCode = $ruleCode;
        $this->apiParas['rule_code'] = $ruleCode;
    }

    public function getRuleCode()
    {
        return $this->ruleCode;
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

    public function setScore($score)
    {
        $this->score = $score;
        $this->apiParas['score'] = $score;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
        $this->apiParas['tenant_id'] = $tenantId;
    }

    public function getTenantId()
    {
        return $this->tenantId;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        $this->apiParas['uuid'] = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.project.point.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->actionTime, 'actionTime');
        RequestCheckUtil::checkNotNull($this->ruleName, 'ruleName');
        RequestCheckUtil::checkNotNull($this->score, 'score');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
        RequestCheckUtil::checkNotNull($this->uuid, 'uuid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
