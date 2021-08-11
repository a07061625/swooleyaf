<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getIgnoreStatus()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNodeType()
 * @method string getClientToken()
 */
class ShrinkNode extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/actions/shrink';

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
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['clientToken'] = $value;

        return $this;
    }
}
