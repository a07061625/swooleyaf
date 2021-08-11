<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceId()
 */
class DeleteNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/paas/namespace';

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
