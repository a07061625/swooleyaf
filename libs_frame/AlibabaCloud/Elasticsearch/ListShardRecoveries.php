<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getActiveOnly()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListShardRecoveries extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/cat-recovery';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withActiveOnly($value)
    {
        $this->data['ActiveOnly'] = $value;
        $this->options['query']['activeOnly'] = $value;

        return $this;
    }
}
