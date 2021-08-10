<?php

namespace AlibabaCloud\Eipanycast;

/**
 * @method string getBusinessStatus()
 * @method $this withBusinessStatus($value)
 * @method string getServiceLocation()
 * @method $this withServiceLocation($value)
 * @method string getAnycastEipAddress()
 * @method $this withAnycastEipAddress($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getAnycastId()
 * @method $this withAnycastId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getBindInstanceIds()
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListAnycastEipAddresses extends Rpc
{
    /**
     * @return $this
     */
    public function withBindInstanceIds(array $bindInstanceIds)
    {
        $this->data['BindInstanceIds'] = $bindInstanceIds;
        foreach ($bindInstanceIds as $i => $iValue) {
            $this->options['query']['BindInstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
