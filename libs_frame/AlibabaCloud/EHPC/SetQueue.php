<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getQueueName()
 * @method $this withQueueName($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getNode()
 */
class SetQueue extends Rpc
{
    /**
     * @return $this
     */
    public function withNode(array $node)
    {
        $this->data['Node'] = $node;
        foreach ($node as $depth1 => $depth1Value) {
            if (isset($depth1Value['Name'])) {
                $this->options['query']['Node.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
        }

        return $this;
    }
}
