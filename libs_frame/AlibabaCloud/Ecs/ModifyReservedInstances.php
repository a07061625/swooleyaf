<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getConfiguration()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getReservedInstanceId()
 */
class ModifyReservedInstances extends Rpc
{
    /**
     * @return $this
     */
    public function withConfiguration(array $configuration)
    {
        $this->data['Configuration'] = $configuration;
        foreach ($configuration as $depth1 => $depth1Value) {
            if (isset($depth1Value['ZoneId'])) {
                $this->options['query']['Configuration.' . ($depth1 + 1) . '.ZoneId'] = $depth1Value['ZoneId'];
            }
            if (isset($depth1Value['ReservedInstanceName'])) {
                $this->options['query']['Configuration.' . ($depth1 + 1) . '.ReservedInstanceName'] = $depth1Value['ReservedInstanceName'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['Configuration.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['Scope'])) {
                $this->options['query']['Configuration.' . ($depth1 + 1) . '.Scope'] = $depth1Value['Scope'];
            }
            if (isset($depth1Value['InstanceAmount'])) {
                $this->options['query']['Configuration.' . ($depth1 + 1) . '.InstanceAmount'] = $depth1Value['InstanceAmount'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withReservedInstanceId(array $reservedInstanceId)
    {
        $this->data['ReservedInstanceId'] = $reservedInstanceId;
        foreach ($reservedInstanceId as $i => $iValue) {
            $this->options['query']['ReservedInstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
