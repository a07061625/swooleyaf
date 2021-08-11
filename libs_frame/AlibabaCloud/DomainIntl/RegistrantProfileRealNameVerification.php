<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getIdentityCredentialType()
 * @method $this withIdentityCredentialType($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getRegistrantProfileID()
 * @method $this withRegistrantProfileID($value)
 * @method string getIdentityCredential()
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getIdentityCredentialNo()
 * @method $this withIdentityCredentialNo($value)
 */
class RegistrantProfileRealNameVerification extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIdentityCredential($value)
    {
        $this->data['IdentityCredential'] = $value;
        $this->options['form_params']['IdentityCredential'] = $value;

        return $this;
    }
}
