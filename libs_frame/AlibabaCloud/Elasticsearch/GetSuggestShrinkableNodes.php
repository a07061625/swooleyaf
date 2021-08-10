<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getIgnoreStatus()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNodeType()
 * @method string getCount()
 */
class GetSuggestShrinkableNodes extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/suggest-shrinkable-nodes';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIgnoreStatus($value)
    {
        $this->data['IgnoreStatus'] = $value;
        $this->options['query']['ignoreStatus'] = $value;

        return $this;
    }

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
