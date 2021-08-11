<?php

namespace AlibabaCloud\Xspace;

/**
 * @method string getPhone()
 */
class QueryCustomerByPhone extends Roa
{
    /** @var string */
    public $pathPattern = '/customerbyphone';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPhone($value)
    {
        $this->data['Phone'] = $value;
        $this->options['query']['Phone'] = $value;

        return $this;
    }
}
