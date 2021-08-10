<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSystemDiskCategory()
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getDataDisk()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class DescribeInstanceModificationPrice extends Rpc
{
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
     * @return $this
     */
    public function withDataDisk(array $dataDisk)
    {
        $this->data['DataDisk'] = $dataDisk;
        foreach ($dataDisk as $depth1 => $depth1Value) {
            if (isset($depth1Value['Size'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['PerformanceLevel'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.PerformanceLevel'] = $depth1Value['PerformanceLevel'];
            }
        }

        return $this;
    }
}
