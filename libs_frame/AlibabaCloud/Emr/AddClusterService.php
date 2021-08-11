<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getService()
 * @method string getComment()
 * @method $this withComment($value)
 */
class AddClusterService extends Rpc
{
    /**
     * @return $this
     */
    public function withService(array $service)
    {
        $this->data['Service'] = $service;
        foreach ($service as $depth1 => $depth1Value) {
            if (isset($depth1Value['ServiceVersion'])) {
                $this->options['query']['Service.' . ($depth1 + 1) . '.ServiceVersion'] = $depth1Value['ServiceVersion'];
            }
            if (isset($depth1Value['ServiceName'])) {
                $this->options['query']['Service.' . ($depth1 + 1) . '.ServiceName'] = $depth1Value['ServiceName'];
            }
        }

        return $this;
    }
}
