<?php

namespace AlibabaCloud\Ga;

/**
 * @method array getIpSets()
 */
class UpdateIpSets extends Rpc
{
    /**
     * @return $this
     */
    public function withIpSets(array $ipSets)
    {
        $this->data['IpSets'] = $ipSets;
        foreach ($ipSets as $depth1 => $depth1Value) {
            if (isset($depth1Value['Bandwidth'])) {
                $this->options['query']['IpSets.' . ($depth1 + 1) . '.Bandwidth'] = $depth1Value['Bandwidth'];
            }
            if (isset($depth1Value['IpSetId'])) {
                $this->options['query']['IpSets.' . ($depth1 + 1) . '.IpSetId'] = $depth1Value['IpSetId'];
            }
        }

        return $this;
    }
}
