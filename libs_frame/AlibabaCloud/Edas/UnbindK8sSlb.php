<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getClusterId()
 * @method string getType()
 */
class UnbindK8sSlb extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/k8s_slb_binding';

    /** @var string */
    public $method = 'DELETE';

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
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['ClusterId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['query']['Type'] = $value;

        return $this;
    }
}
