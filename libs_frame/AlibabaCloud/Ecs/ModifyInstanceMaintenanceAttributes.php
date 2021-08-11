<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getMaintenanceWindow()
 * @method string getActionOnMaintenance()
 * @method $this withActionOnMaintenance($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getInstanceId()
 * @method string getNotifyOnMaintenance()
 * @method $this withNotifyOnMaintenance($value)
 */
class ModifyInstanceMaintenanceAttributes extends Rpc
{
    /**
     * @return $this
     */
    public function withMaintenanceWindow(array $maintenanceWindow)
    {
        $this->data['MaintenanceWindow'] = $maintenanceWindow;
        foreach ($maintenanceWindow as $depth1 => $depth1Value) {
            if (isset($depth1Value['StartTime'])) {
                $this->options['query']['MaintenanceWindow.' . ($depth1 + 1) . '.StartTime'] = $depth1Value['StartTime'];
            }
            if (isset($depth1Value['EndTime'])) {
                $this->options['query']['MaintenanceWindow.' . ($depth1 + 1) . '.EndTime'] = $depth1Value['EndTime'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceId(array $instanceId)
    {
        $this->data['InstanceId'] = $instanceId;
        foreach ($instanceId as $i => $iValue) {
            $this->options['query']['InstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
