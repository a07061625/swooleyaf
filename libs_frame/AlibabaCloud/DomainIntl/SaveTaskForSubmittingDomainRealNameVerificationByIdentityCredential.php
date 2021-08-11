<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getIdentityCredentialType()
 * @method $this withIdentityCredentialType($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getIdentityCredential()
 * @method array getDomainName()
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getIdentityCredentialNo()
 * @method $this withIdentityCredentialNo($value)
 */
class SaveTaskForSubmittingDomainRealNameVerificationByIdentityCredential extends Rpc
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

    /**
     * @return $this
     */
    public function withDomainName(array $domainName)
    {
        $this->data['DomainName'] = $domainName;
        foreach ($domainName as $i => $iValue) {
            $this->options['query']['DomainName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
