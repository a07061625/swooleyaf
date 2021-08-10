<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getTrigger()
 */
class UpdatePipelines extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/pipelines';

    /** @var string */
    public $method = 'PUT';

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
    public function withTrigger($value)
    {
        $this->data['Trigger'] = $value;
        $this->options['query']['trigger'] = $value;

        return $this;
    }
}
