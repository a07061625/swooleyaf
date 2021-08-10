<?php

namespace AlibabaCloud\Smartag;

/**
 * @method array getDpiGroupIds()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSourcePortRange()
 * @method $this withSourcePortRange($value)
 * @method string getSourceCidr()
 * @method $this withSourceCidr($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getDestCidr()
 * @method $this withDestCidr($value)
 * @method array getDpiSignatureIds()
 * @method string getQosId()
 * @method $this withQosId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getIpProtocol()
 * @method $this withIpProtocol($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPriority()
 * @method $this withPriority($value)
 * @method string getDestPortRange()
 * @method $this withDestPortRange($value)
 * @method string getName()
 * @method $this withName($value)
 */
class CreateQosPolicy extends Rpc
{
    /**
     * @return $this
     */
    public function withDpiGroupIds(array $dpiGroupIds)
    {
        $this->data['DpiGroupIds'] = $dpiGroupIds;
        foreach ($dpiGroupIds as $i => $iValue) {
            $this->options['query']['DpiGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDpiSignatureIds(array $dpiSignatureIds)
    {
        $this->data['DpiSignatureIds'] = $dpiSignatureIds;
        foreach ($dpiSignatureIds as $i => $iValue) {
            $this->options['query']['DpiSignatureIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
