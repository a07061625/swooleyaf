<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getExpireAt()
 * @method $this withExpireAt($value)
 * @method array getDay()
 * @method string getRunnableTimeTo()
 * @method $this withRunnableTimeTo($value)
 * @method string getTriggerPeriod()
 * @method $this withTriggerPeriod($value)
 * @method string getGroupName()
 * @method $this withGroupName($value)
 * @method array getVideoUrl()
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getRunnableTimeFrom()
 * @method $this withRunnableTimeFrom($value)
 * @method string getRuleId()
 * @method $this withRuleId($value)
 */
class CreateTaskGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withDay(array $day)
    {
        $this->data['Day'] = $day;
        foreach ($day as $i => $iValue) {
            $this->options['query']['Day.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withVideoUrl(array $videoUrl)
    {
        $this->data['VideoUrl'] = $videoUrl;
        foreach ($videoUrl as $i => $iValue) {
            $this->options['query']['VideoUrl.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
