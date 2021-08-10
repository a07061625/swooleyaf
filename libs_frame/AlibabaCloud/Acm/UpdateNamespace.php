<?php

namespace AlibabaCloud\Acm;

/**
 * @method string getNamespaceName()
 * @method string getNamespaceId()
 */
class UpdateNamespace extends Roa
{
    /** @var string */
    public $pathPattern = '/diamond-ops/pop/namespace';

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
        $this->options['form_params']['NamespaceName'] = $value;

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
        $this->options['form_params']['NamespaceId'] = $value;

        return $this;
    }
}
