<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getGrayBid()
 * @method $this withGrayBid($value)
 * @method string getGrayAliUid()
 * @method $this withGrayAliUid($value)
 * @method array getEcsInstanceId()
 * @method array getVSwitchId()
 */
class InnerDeleteNcExpression extends Rpc
{
    /**
     * @return $this
     */
    public function withEcsInstanceId(array $ecsInstanceId)
    {
        $this->data['EcsInstanceId'] = $ecsInstanceId;
        foreach ($ecsInstanceId as $i => $iValue) {
            $this->options['query']['EcsInstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withVSwitchId(array $vSwitchId)
    {
        $this->data['VSwitchId'] = $vSwitchId;
        foreach ($vSwitchId as $i => $iValue) {
            $this->options['query']['VSwitchId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
