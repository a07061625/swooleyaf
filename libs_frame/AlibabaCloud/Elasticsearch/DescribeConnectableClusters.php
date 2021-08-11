<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAlreadySetItems()
 */
class DescribeConnectableClusters extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/connectable-clusters';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlreadySetItems($value)
    {
        $this->data['AlreadySetItems'] = $value;
        $this->options['query']['alreadySetItems'] = $value;

        return $this;
    }
}
