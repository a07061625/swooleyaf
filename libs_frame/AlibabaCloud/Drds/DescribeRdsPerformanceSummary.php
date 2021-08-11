<?php

namespace AlibabaCloud\Drds;

/**
 * @method array getRdsInstanceId()
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 */
class DescribeRdsPerformanceSummary extends Rpc
{
    /**
     * @return $this
     */
    public function withRdsInstanceId(array $rdsInstanceId)
    {
        $this->data['RdsInstanceId'] = $rdsInstanceId;
        foreach ($rdsInstanceId as $i => $iValue) {
            $this->options['query']['RdsInstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
