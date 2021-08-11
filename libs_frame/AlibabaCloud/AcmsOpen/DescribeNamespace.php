<?php

namespace AlibabaCloud\AcmsOpen;

/**
 * @method string getNamespaceId()
 */
class DescribeNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/diamond-ops/pop/namespace';

    /** @var string */
    public $method = 'GET';

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
