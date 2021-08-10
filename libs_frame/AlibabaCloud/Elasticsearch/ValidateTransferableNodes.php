<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNodeType()
 */
class ValidateTransferableNodes extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/validate-transfer-nodes';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeType($value)
    {
        $this->data['NodeType'] = $value;
        $this->options['query']['nodeType'] = $value;

        return $this;
    }
}
