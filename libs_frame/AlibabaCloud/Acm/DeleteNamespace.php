<?php

namespace AlibabaCloud\Acm;

/**
 * @method string getNamespaceId()
 */
class DeleteNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/diamond-ops/pop/namespace';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceId($value)
    {
        $this->data['NamespaceId'] = $value;
        $this->options['query']['NamespaceId'] = $value;

        return $this;
    }
}
