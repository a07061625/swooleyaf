<?php

namespace AlibabaCloud\Ga;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getAcceleratorId()
 * @method $this withAcceleratorId($value)
 * @method array getAccelerateRegion()
 */
class CreateIpSets extends Rpc
{
    /**
     * @return $this
     */
    public function withAccelerateRegion(array $accelerateRegion)
    {
        $this->data['AccelerateRegion'] = $accelerateRegion;
        foreach ($accelerateRegion as $depth1 => $depth1Value) {
            if (isset($depth1Value['AccelerateRegionId'])) {
                $this->options['query']['AccelerateRegion.' . ($depth1 + 1) . '.AccelerateRegionId'] = $depth1Value['AccelerateRegionId'];
            }
            if (isset($depth1Value['IpVersion'])) {
                $this->options['query']['AccelerateRegion.' . ($depth1 + 1) . '.IpVersion'] = $depth1Value['IpVersion'];
            }
            if (isset($depth1Value['Bandwidth'])) {
                $this->options['query']['AccelerateRegion.' . ($depth1 + 1) . '.Bandwidth'] = $depth1Value['Bandwidth'];
            }
        }

        return $this;
    }
}
