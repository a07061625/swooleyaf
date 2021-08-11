<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAlreadySetItems()
 */
class ListAlternativeSnapshotRepos extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/alternative-snapshot-repos';

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
