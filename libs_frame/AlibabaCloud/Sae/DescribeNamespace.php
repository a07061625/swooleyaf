<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceId()
 */
class DescribeNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/paas/namespace';

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
