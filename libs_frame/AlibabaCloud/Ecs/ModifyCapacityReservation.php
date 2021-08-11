<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPlatform()
 * @method $this withPlatform($value)
 * @method string getPrivatePoolOptionsId()
 * @method string getEndTimeType()
 * @method $this withEndTimeType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getPrivatePoolOptionsName()
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPackageType()
 * @method $this withPackageType($value)
 * @method string getInstanceAmount()
 * @method $this withInstanceAmount($value)
 */
class ModifyCapacityReservation extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrivatePoolOptionsId($value)
    {
        $this->data['PrivatePoolOptionsId'] = $value;
        $this->options['query']['PrivatePoolOptions.Id'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrivatePoolOptionsName($value)
    {
        $this->data['PrivatePoolOptionsName'] = $value;
        $this->options['query']['PrivatePoolOptions.Name'] = $value;

        return $this;
    }
}
