<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method array getInstanceIds()
 */
class DescribeInstanceStatistics extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
