<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getClusterId()
 */
class GetClusterDetails extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/details';

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
