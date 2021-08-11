<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getIgnoreStatus()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getOrderActionType()
 */
class UpdateInstance extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]';

    /** @var string */
    public $method = 'PUT';

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
    public function withOrderActionType($value)
    {
        $this->data['OrderActionType'] = $value;
        $this->options['query']['orderActionType'] = $value;

        return $this;
    }
}
