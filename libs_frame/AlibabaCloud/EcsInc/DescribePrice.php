<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getDataDisk3Size()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getDataDisk3Category()
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getInternetMaxBandwidthOut()
 * @method $this withInternetMaxBandwidthOut($value)
 * @method string getSystemDiskCategory()
 * @method string getDataDisk4Category()
 * @method string getDataDisk4Size()
 * @method string getPriceUnit()
 * @method $this withPriceUnit($value)
 * @method string getScope()
 * @method $this withScope($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getDedicatedHostType()
 * @method $this withDedicatedHostType($value)
 * @method string getDataDisk2Category()
 * @method string getDataDisk1Size()
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getAmount()
 * @method $this withAmount($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getDataDisk2Size()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getDataDisk1Category()
 * @method string getSystemDiskSize()
 * @method string getOfferingType()
 * @method $this withOfferingType($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getInstanceAmount()
 * @method $this withInstanceAmount($value)
 */
class DescribePrice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk3Size($value)
    {
        $this->data['DataDisk3Size'] = $value;
        $this->options['query']['DataDisk.3.Size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk3Category($value)
    {
        $this->data['DataDisk3Category'] = $value;
        $this->options['query']['DataDisk.3.Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskCategory($value)
    {
        $this->data['SystemDiskCategory'] = $value;
        $this->options['query']['SystemDisk.Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk4Category($value)
    {
        $this->data['DataDisk4Category'] = $value;
        $this->options['query']['DataDisk.4.Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk4Size($value)
    {
        $this->data['DataDisk4Size'] = $value;
        $this->options['query']['DataDisk.4.Size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk2Category($value)
    {
        $this->data['DataDisk2Category'] = $value;
        $this->options['query']['DataDisk.2.Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk1Size($value)
    {
        $this->data['DataDisk1Size'] = $value;
        $this->options['query']['DataDisk.1.Size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk2Size($value)
    {
        $this->data['DataDisk2Size'] = $value;
        $this->options['query']['DataDisk.2.Size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDisk1Category($value)
    {
        $this->data['DataDisk1Category'] = $value;
        $this->options['query']['DataDisk.1.Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskSize($value)
    {
        $this->data['SystemDiskSize'] = $value;
        $this->options['query']['SystemDisk.Size'] = $value;

        return $this;
    }
}
