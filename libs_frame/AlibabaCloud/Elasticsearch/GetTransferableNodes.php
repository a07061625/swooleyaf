<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNodeType()
 * @method string getCount()
 */
class GetTransferableNodes extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/transferable-nodes';

    /** @var string */
    public $method = 'GET';

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
    public function withCount($value)
    {
        $this->data['Count'] = $value;
        $this->options['query']['count'] = $value;

        return $this;
    }
}
