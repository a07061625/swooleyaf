<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getForce()
 */
class RestartInstance extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/actions/restart';

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
    public function withForce($value)
    {
        $this->data['Force'] = $value;
        $this->options['query']['force'] = $value;

        return $this;
    }
}
