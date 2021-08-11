<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getCount()
 * @method string getModel()
 * @method string getUserVSwitch()
 * @method string getClusterId()
 */
class ExpandCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/expand';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCount($value)
    {
        $this->data['Count'] = $value;
        $this->options['form_params']['count'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModel($value)
    {
        $this->data['Model'] = $value;
        $this->options['form_params']['model'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserVSwitch($value)
    {
        $this->data['UserVSwitch'] = $value;
        $this->options['form_params']['userVSwitch'] = $value;

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
}
