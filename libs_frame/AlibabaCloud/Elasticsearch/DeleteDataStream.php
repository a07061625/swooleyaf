<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getDataStream()
 * @method $this withDataStream($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 */
class DeleteDataStream extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/data-streams/[DataStream]';

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
