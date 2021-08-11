<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getLineType()
 * @method $this withLineType($value)
 * @method string getSi()
 * @method $this withSi($value)
 * @method string getPeerLocation()
 * @method $this withPeerLocation($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBandwidth()
 * @method $this withBandwidth($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getConstructionTime()
 * @method $this withConstructionTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getCompanyName()
 * @method $this withCompanyName($value)
 * @method array getPMInfo()
 */
class ApplyPhysicalConnectionLOA extends Rpc
{
    /**
     * @return $this
     */
    public function withPMInfo(array $pMInfo)
    {
        $this->data['PMInfo'] = $pMInfo;
        foreach ($pMInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['PMCertificateNo'])) {
                $this->options['query']['PMInfo.' . ($depth1 + 1) . '.PMCertificateNo'] = $depth1Value['PMCertificateNo'];
            }
            if (isset($depth1Value['PMName'])) {
                $this->options['query']['PMInfo.' . ($depth1 + 1) . '.PMName'] = $depth1Value['PMName'];
            }
            if (isset($depth1Value['PMCertificateType'])) {
                $this->options['query']['PMInfo.' . ($depth1 + 1) . '.PMCertificateType'] = $depth1Value['PMCertificateType'];
            }
            if (isset($depth1Value['PMContactInfo'])) {
                $this->options['query']['PMInfo.' . ($depth1 + 1) . '.PMContactInfo'] = $depth1Value['PMContactInfo'];
            }
            if (isset($depth1Value['PMGender'])) {
                $this->options['query']['PMInfo.' . ($depth1 + 1) . '.PMGender'] = $depth1Value['PMGender'];
            }
        }

        return $this;
    }
}
