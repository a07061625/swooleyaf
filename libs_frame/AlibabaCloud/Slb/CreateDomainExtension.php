<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getAccessKeyId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getServerCertificate()
 * @method string getListenerPort()
 * @method $this withListenerPort($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getCertificateId()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getServerCertificateId()
 * @method $this withServerCertificateId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getLoadBalancerId()
 * @method $this withLoadBalancerId($value)
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class CreateDomainExtension extends Rpc
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
    public function withServerCertificate(array $serverCertificate)
    {
        $this->data['ServerCertificate'] = $serverCertificate;
        foreach ($serverCertificate as $depth1 => $depth1Value) {
            if (isset($depth1Value['BindingType'])) {
                $this->options['query']['ServerCertificate.' . ($depth1 + 1) . '.BindingType'] = $depth1Value['BindingType'];
            }
            if (isset($depth1Value['CertificateId'])) {
                $this->options['query']['ServerCertificate.' . ($depth1 + 1) . '.CertificateId'] = $depth1Value['CertificateId'];
            }
            if (isset($depth1Value['StandardType'])) {
                $this->options['query']['ServerCertificate.' . ($depth1 + 1) . '.StandardType'] = $depth1Value['StandardType'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withCertificateId(array $certificateId)
    {
        $this->data['CertificateId'] = $certificateId;
        foreach ($certificateId as $i => $iValue) {
            $this->options['query']['CertificateId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
