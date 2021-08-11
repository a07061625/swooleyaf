<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getInstanceIds()
 * @method string getForce()
 * @method $this withForce($value)
 */
class InstallMonitoringAgent extends Rpc
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
