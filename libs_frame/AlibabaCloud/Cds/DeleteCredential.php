<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getCredentialId()
 */
class DeleteCredential extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/credential/delete';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCredentialId($value)
    {
        $this->data['CredentialId'] = $value;
        $this->options['query']['CredentialId'] = $value;

        return $this;
    }
}
