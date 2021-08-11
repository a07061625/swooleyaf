<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getInstances()
 * @method string getGroupId()
 * @method $this withGroupId($value)
 */
class CreateMonitorGroupInstances extends Rpc
{
    /**
     * @return $this
     */
    public function withInstances(array $instances)
    {
        $this->data['Instances'] = $instances;
        foreach ($instances as $depth1 => $depth1Value) {
            if (isset($depth1Value['InstanceId'])) {
                $this->options['query']['Instances.' . ($depth1 + 1) . '.InstanceId'] = $depth1Value['InstanceId'];
            }
            if (isset($depth1Value['InstanceName'])) {
                $this->options['query']['Instances.' . ($depth1 + 1) . '.InstanceName'] = $depth1Value['InstanceName'];
            }
            if (isset($depth1Value['RegionId'])) {
                $this->options['query']['Instances.' . ($depth1 + 1) . '.RegionId'] = $depth1Value['RegionId'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['Instances.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
        }

        return $this;
    }
}
