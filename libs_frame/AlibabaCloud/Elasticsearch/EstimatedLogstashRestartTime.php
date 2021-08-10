<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getForce()
 */
class EstimatedLogstashRestartTime extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/estimated-time/restart-time';

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
