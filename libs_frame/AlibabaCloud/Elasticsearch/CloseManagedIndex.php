<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getIndex()
 * @method $this withIndex($value)
 */
class CloseManagedIndex extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/indices/[Index]/close-managed';

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
