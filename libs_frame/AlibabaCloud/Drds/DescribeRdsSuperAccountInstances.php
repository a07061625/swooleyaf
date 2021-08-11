<?php

namespace AlibabaCloud\Drds;

/**
 * @method array getRdsInstance()
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getDbInstType()
 * @method $this withDbInstType($value)
 */
class DescribeRdsSuperAccountInstances extends Rpc
{
    /**
     * @return $this
     */
    public function withRdsInstance(array $rdsInstance)
    {
        $this->data['RdsInstance'] = $rdsInstance;
        foreach ($rdsInstance as $i => $iValue) {
            $this->options['query']['RdsInstance.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
