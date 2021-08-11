<?php

namespace AlibabaCloud\Ga;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSlsLogStoreName()
 * @method $this withSlsLogStoreName($value)
 * @method string getListenerId()
 * @method $this withListenerId($value)
 * @method array getEndpointGroupIds()
 * @method string getSlsProjectName()
 * @method $this withSlsProjectName($value)
 * @method string getSlsRegionId()
 * @method $this withSlsRegionId($value)
 * @method string getAcceleratorId()
 * @method $this withAcceleratorId($value)
 */
class AttachLogStoreToEndpointGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withEndpointGroupIds(array $endpointGroupIds)
    {
        $this->data['EndpointGroupIds'] = $endpointGroupIds;
        foreach ($endpointGroupIds as $i => $iValue) {
            $this->options['query']['EndpointGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
