<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getCertificateId()
 * @method array getVpnGatewayId()
 * @method string getCallerBid()
 * @method string getCertificateType()
 * @method $this withCertificateType($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListVpnCertificateAssociations extends Rpc
{
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

    /**
     * @return $this
     */
    public function withVpnGatewayId(array $vpnGatewayId)
    {
        $this->data['VpnGatewayId'] = $vpnGatewayId;
        foreach ($vpnGatewayId as $i => $iValue) {
            $this->options['query']['VpnGatewayId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallerBid($value)
    {
        $this->data['CallerBid'] = $value;
        $this->options['query']['callerBid'] = $value;

        return $this;
    }
}
