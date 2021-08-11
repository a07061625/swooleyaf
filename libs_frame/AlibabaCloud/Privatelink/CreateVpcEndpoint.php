<?php

namespace AlibabaCloud\Privatelink;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getSecurityGroupId()
 * @method array getZone()
 * @method string getServiceName()
 * @method $this withServiceName($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getEndpointDescription()
 * @method $this withEndpointDescription($value)
 * @method string getEndpointName()
 * @method $this withEndpointName($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getServiceId()
 * @method $this withServiceId($value)
 */
class CreateVpcEndpoint extends Rpc
{
    /**
     * @return $this
     */
    public function withSecurityGroupId(array $securityGroupId)
    {
        $this->data['SecurityGroupId'] = $securityGroupId;
        foreach ($securityGroupId as $i => $iValue) {
            $this->options['query']['SecurityGroupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withZone(array $zone)
    {
        $this->data['Zone'] = $zone;
        foreach ($zone as $depth1 => $depth1Value) {
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['Zone.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
            }
            if (isset($depth1Value['ZoneId'])) {
                $this->options['query']['Zone.' . ($depth1 + 1) . '.ZoneId'] = $depth1Value['ZoneId'];
            }
            if (isset($depth1Value['Ip'])) {
                $this->options['query']['Zone.' . ($depth1 + 1) . '.ip'] = $depth1Value['Ip'];
            }
        }

        return $this;
    }
}
