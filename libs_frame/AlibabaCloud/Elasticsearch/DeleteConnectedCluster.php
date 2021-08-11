<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getConnectedInstanceId()
 */
class DeleteConnectedCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/connected-clusters';

    /** @var string */
    public $method = 'DELETE';

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConnectedInstanceId($value)
    {
        $this->data['ConnectedInstanceId'] = $value;
        $this->options['query']['connectedInstanceId'] = $value;

        return $this;
    }
}
