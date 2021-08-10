<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getMem()
 * @method string getLogicalRegionId()
 * @method string getAppId()
 * @method string getGroupId()
 * @method string getInstanceNum()
 * @method string getCpu()
 * @method string getClusterId()
 */
class ListScaleOutEcu extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/scale_out_ecu_list';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMem($value)
    {
        $this->data['Mem'] = $value;
        $this->options['query']['Mem'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogicalRegionId($value)
    {
        $this->data['LogicalRegionId'] = $value;
        $this->options['query']['LogicalRegionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['query']['GroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceNum($value)
    {
        $this->data['InstanceNum'] = $value;
        $this->options['query']['InstanceNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCpu($value)
    {
        $this->data['Cpu'] = $value;
        $this->options['query']['Cpu'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['ClusterId'] = $value;

        return $this;
    }
}
