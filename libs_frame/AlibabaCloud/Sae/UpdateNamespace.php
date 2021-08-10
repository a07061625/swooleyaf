<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceName()
 * @method string getNamespaceDescription()
 * @method string getNamespaceId()
 */
class UpdateNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/paas/namespace';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceName($value)
    {
        $this->data['NamespaceName'] = $value;
        $this->options['query']['NamespaceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceDescription($value)
    {
        $this->data['NamespaceDescription'] = $value;
        $this->options['query']['NamespaceDescription'] = $value;

        return $this;
    }

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
