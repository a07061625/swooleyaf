<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getClusterId()
 */
class DestroyCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->pathParameters['clusterId'] = $value;

        return $this;
    }
}
