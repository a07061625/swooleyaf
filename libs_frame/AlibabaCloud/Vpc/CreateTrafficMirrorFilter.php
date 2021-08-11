<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getIngressRules()
 * @method string getTrafficMirrorFilterName()
 * @method $this withTrafficMirrorFilterName($value)
 * @method array getEgressRules()
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTrafficMirrorFilterDescription()
 * @method $this withTrafficMirrorFilterDescription($value)
 */
class CreateTrafficMirrorFilter extends Rpc
{
    /**
     * @return $this
     */
    public function withIngressRules(array $ingressRules)
    {
        $this->data['IngressRules'] = $ingressRules;
        foreach ($ingressRules as $depth1 => $depth1Value) {
            if (isset($depth1Value['Priority'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.Priority'] = $depth1Value['Priority'];
            }
            if (isset($depth1Value['Action'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.Action'] = $depth1Value['Action'];
            }
            if (isset($depth1Value['Protocol'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.Protocol'] = $depth1Value['Protocol'];
            }
            if (isset($depth1Value['DestinationCidrBlock'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.DestinationCidrBlock'] = $depth1Value['DestinationCidrBlock'];
            }
            if (isset($depth1Value['SourceCidrBlock'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.SourceCidrBlock'] = $depth1Value['SourceCidrBlock'];
            }
            if (isset($depth1Value['DestinationPortRange'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.DestinationPortRange'] = $depth1Value['DestinationPortRange'];
            }
            if (isset($depth1Value['SourcePortRange'])) {
                $this->options['query']['IngressRules.' . ($depth1 + 1) . '.SourcePortRange'] = $depth1Value['SourcePortRange'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withEgressRules(array $egressRules)
    {
        $this->data['EgressRules'] = $egressRules;
        foreach ($egressRules as $depth1 => $depth1Value) {
            if (isset($depth1Value['Priority'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.Priority'] = $depth1Value['Priority'];
            }
            if (isset($depth1Value['Action'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.Action'] = $depth1Value['Action'];
            }
            if (isset($depth1Value['Protocol'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.Protocol'] = $depth1Value['Protocol'];
            }
            if (isset($depth1Value['DestinationCidrBlock'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.DestinationCidrBlock'] = $depth1Value['DestinationCidrBlock'];
            }
            if (isset($depth1Value['SourceCidrBlock'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.SourceCidrBlock'] = $depth1Value['SourceCidrBlock'];
            }
            if (isset($depth1Value['DestinationPortRange'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.DestinationPortRange'] = $depth1Value['DestinationPortRange'];
            }
            if (isset($depth1Value['SourcePortRange'])) {
                $this->options['query']['EgressRules.' . ($depth1 + 1) . '.SourcePortRange'] = $depth1Value['SourcePortRange'];
            }
        }

        return $this;
    }
}
