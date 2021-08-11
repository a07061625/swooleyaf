<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupId()
 * @method array getNodes()
 */
class SubmitExternalNodesAddingTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withNodes(array $nodes)
    {
        $this->data['Nodes'] = $nodes;
        foreach ($nodes as $depth1 => $depth1Value) {
            $this->options['form_params']['Nodes.' . ($depth1 + 1) . '.DevEui'] = $depth1Value['DevEui'];
        }

        return $this;
    }
}
