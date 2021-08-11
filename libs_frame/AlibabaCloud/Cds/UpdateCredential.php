<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getCredentialType()
 * @method string getJsonContent()
 * @method string getCredentialId()
 */
class UpdateCredential extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/credential/update';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCredentialType($value)
    {
        $this->data['CredentialType'] = $value;
        $this->options['query']['CredentialType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJsonContent($value)
    {
        $this->data['JsonContent'] = $value;
        $this->options['query']['JsonContent'] = $value;

        return $this;
    }

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
