<?php

namespace AlibabaCloud\Polardbx;

/**
 * @method string getIsAutoRenew()
 * @method $this withIsAutoRenew($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getDuration()
 * @method $this withDuration($value)
 * @method string getIsHa()
 * @method string getMySQLVersion()
 * @method $this withMySQLVersion($value)
 * @method string getInstanceSeries()
 * @method $this withInstanceSeries($value)
 * @method string getMasterInstId()
 * @method $this withMasterInstId($value)
 * @method string getQuantity()
 * @method $this withQuantity($value)
 * @method string getSpecification()
 * @method $this withSpecification($value)
 * @method string getVswitchId()
 * @method $this withVswitchId($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getPricingCycle()
 * @method $this withPricingCycle($value)
 */
class CreatePolarxInstance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsHa($value)
    {
        $this->data['IsHa'] = $value;
        $this->options['query']['isHa'] = $value;

        return $this;
    }
}
