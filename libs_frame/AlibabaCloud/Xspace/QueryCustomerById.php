<?php

namespace AlibabaCloud\Xspace;

/**
 * @method string getId()
 */
class QueryCustomerById extends Roa
{
    /** @var string */
    public $pathPattern = '/customer';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['query']['Id'] = $value;

        return $this;
    }
}
