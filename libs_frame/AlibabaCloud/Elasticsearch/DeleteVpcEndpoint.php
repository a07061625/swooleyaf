<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getEndpointId()
 * @method $this withEndpointId($value)
 */
class DeleteVpcEndpoint extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/vpc-endpoints/[EndpointId]';

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
        $this->options['query']['ClientToken'] = $value;

        return $this;
    }
}
