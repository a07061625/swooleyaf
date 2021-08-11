<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getClusterId()
 */
class GetClusterResource extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/resource';

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
