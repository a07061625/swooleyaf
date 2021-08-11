<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getClusterType()
 * @method string getIaasProvider()
 * @method string getLogicalRegionId()
 * @method string getClusterName()
 * @method string getVpcId()
 * @method string getNetworkMode()
 * @method string getOversoldFactor()
 */
class InsertCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/cluster';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterType($value)
    {
        $this->data['ClusterType'] = $value;
        $this->options['query']['ClusterType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIaasProvider($value)
    {
        $this->data['IaasProvider'] = $value;
        $this->options['query']['IaasProvider'] = $value;

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
    public function withClusterName($value)
    {
        $this->data['ClusterName'] = $value;
        $this->options['query']['ClusterName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcId($value)
    {
        $this->data['VpcId'] = $value;
        $this->options['query']['VpcId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNetworkMode($value)
    {
        $this->data['NetworkMode'] = $value;
        $this->options['query']['NetworkMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOversoldFactor($value)
    {
        $this->data['OversoldFactor'] = $value;
        $this->options['query']['OversoldFactor'] = $value;

        return $this;
    }
}
