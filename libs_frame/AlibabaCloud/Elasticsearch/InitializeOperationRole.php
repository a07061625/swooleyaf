<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClientToken()
 */
class InitializeOperationRole extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/user/slr';

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
