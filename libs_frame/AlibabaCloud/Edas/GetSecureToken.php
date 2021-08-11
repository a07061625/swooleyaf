<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getNamespaceId()
 */
class GetSecureToken extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/secure_token';

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
