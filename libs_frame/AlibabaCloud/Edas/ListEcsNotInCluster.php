<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getVpcId()
 * @method string getNetworkMode()
 */
class ListEcsNotInCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/ecs_not_in_cluster';

    /** @var string */
    public $method = 'GET';

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
}
