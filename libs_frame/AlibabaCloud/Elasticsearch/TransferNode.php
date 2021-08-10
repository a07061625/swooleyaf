<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNodeType()
 * @method string getClientToken()
 */
class TransferNode extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/actions/transfer';

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['clientToken'] = $value;

        return $this;
    }
}
