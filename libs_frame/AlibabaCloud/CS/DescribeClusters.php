<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterType()
 * @method string getName()
 */
class DescribeClusters extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterType($value)
    {
        $this->data['ClusterType'] = $value;
        $this->options['query']['clusterType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['query']['Name'] = $value;

        return $this;
    }
}
