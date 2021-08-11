<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getAccessKeyId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTLSCipherPolicyId()
 * @method $this withTLSCipherPolicyId($value)
 * @method array getCiphers()
 * @method array getTLSVersions()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 */
class SetTLSCipherPolicyAttribute extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessKeyId($value)
    {
        $this->data['AccessKeyId'] = $value;
        $this->options['query']['access_key_id'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withCiphers(array $ciphers)
    {
        $this->data['Ciphers'] = $ciphers;
        foreach ($ciphers as $i => $iValue) {
            $this->options['query']['Ciphers.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTLSVersions(array $tLSVersions)
    {
        $this->data['TLSVersions'] = $tLSVersions;
        foreach ($tLSVersions as $i => $iValue) {
            $this->options['query']['TLSVersions.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
