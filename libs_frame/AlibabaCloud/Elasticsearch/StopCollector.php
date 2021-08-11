<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClientToken()
 * @method string getResId()
 * @method $this withResId($value)
 */
class StopCollector extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/collectors/[ResId]/actions/stop';

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
