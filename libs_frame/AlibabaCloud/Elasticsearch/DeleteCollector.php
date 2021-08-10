<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClientToken()
 * @method string getResId()
 * @method $this withResId($value)
 */
class DeleteCollector extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/collectors/[ResId]';

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
