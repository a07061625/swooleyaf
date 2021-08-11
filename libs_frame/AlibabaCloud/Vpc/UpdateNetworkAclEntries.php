<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getEgressAclEntries()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getNetworkAclId()
 * @method $this withNetworkAclId($value)
 * @method string getUpdateIngressAclEntries()
 * @method $this withUpdateIngressAclEntries($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getUpdateEgressAclEntries()
 * @method $this withUpdateEgressAclEntries($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getIngressAclEntries()
 */
class UpdateNetworkAclEntries extends Rpc
{
    /**
     * @return $this
     */
    public function withEgressAclEntries(array $egressAclEntries)
    {
        $this->data['EgressAclEntries'] = $egressAclEntries;
        foreach ($egressAclEntries as $depth1 => $depth1Value) {
            if (isset($depth1Value['NetworkAclEntryName'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.NetworkAclEntryName'] = $depth1Value['NetworkAclEntryName'];
            }
            if (isset($depth1Value['NetworkAclEntryId'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.NetworkAclEntryId'] = $depth1Value['NetworkAclEntryId'];
            }
            if (isset($depth1Value['Policy'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.Policy'] = $depth1Value['Policy'];
            }
            if (isset($depth1Value['Protocol'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.Protocol'] = $depth1Value['Protocol'];
            }
            if (isset($depth1Value['DestinationCidrIp'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.DestinationCidrIp'] = $depth1Value['DestinationCidrIp'];
            }
            if (isset($depth1Value['Port'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.Port'] = $depth1Value['Port'];
            }
            if (isset($depth1Value['EntryType'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.EntryType'] = $depth1Value['EntryType'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['EgressAclEntries.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withIngressAclEntries(array $ingressAclEntries)
    {
        $this->data['IngressAclEntries'] = $ingressAclEntries;
        foreach ($ingressAclEntries as $depth1 => $depth1Value) {
            if (isset($depth1Value['NetworkAclEntryName'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.NetworkAclEntryName'] = $depth1Value['NetworkAclEntryName'];
            }
            if (isset($depth1Value['NetworkAclEntryId'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.NetworkAclEntryId'] = $depth1Value['NetworkAclEntryId'];
            }
            if (isset($depth1Value['Policy'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.Policy'] = $depth1Value['Policy'];
            }
            if (isset($depth1Value['Protocol'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.Protocol'] = $depth1Value['Protocol'];
            }
            if (isset($depth1Value['SourceCidrIp'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.SourceCidrIp'] = $depth1Value['SourceCidrIp'];
            }
            if (isset($depth1Value['Port'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.Port'] = $depth1Value['Port'];
            }
            if (isset($depth1Value['EntryType'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.EntryType'] = $depth1Value['EntryType'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['IngressAclEntries.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
        }

        return $this;
    }
}
