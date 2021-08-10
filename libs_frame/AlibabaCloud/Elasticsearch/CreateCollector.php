<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClientToken()
 */
class CreateCollector extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/collectors';

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
}
