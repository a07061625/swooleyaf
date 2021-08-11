<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getInstanceIds()
 * @method string getClusterId()
 * @method string getModelTargetCount()
 */
class ShrinkCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/shrink';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['form_params']['instanceIds'] = $value;

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
        $this->pathParameters['clusterId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelTargetCount($value)
    {
        $this->data['ModelTargetCount'] = $value;
        $this->options['form_params']['modelTargetCount'] = $value;

        return $this;
    }
}
