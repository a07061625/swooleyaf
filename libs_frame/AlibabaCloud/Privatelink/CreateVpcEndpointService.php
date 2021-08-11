<?php

namespace AlibabaCloud\Privatelink;

/**
 * @method string getAutoAcceptEnabled()
 * @method $this withAutoAcceptEnabled($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getPayer()
 * @method $this withPayer($value)
 * @method string getZoneAffinityEnabled()
 * @method $this withZoneAffinityEnabled($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method array getResource()
 * @method string getServiceDescription()
 * @method $this withServiceDescription($value)
 */
class CreateVpcEndpointService extends Rpc
{
    /**
     * @return $this
     */
    public function withResource(array $resource)
    {
        $this->data['Resource'] = $resource;
        foreach ($resource as $depth1 => $depth1Value) {
            if (isset($depth1Value['ResourceType'])) {
                $this->options['query']['Resource.' . ($depth1 + 1) . '.ResourceType'] = $depth1Value['ResourceType'];
            }
            if (isset($depth1Value['ResourceId'])) {
                $this->options['query']['Resource.' . ($depth1 + 1) . '.ResourceId'] = $depth1Value['ResourceId'];
            }
        }

        return $this;
    }
}
