<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getSlbId()
 * @method string getSlbProtocol()
 * @method string getPort()
 * @method string getAppId()
 * @method string getClusterId()
 * @method string getType()
 * @method string getTargetPort()
 */
class BindK8sSlb extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/k8s_slb_binding';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSlbId($value)
    {
        $this->data['SlbId'] = $value;
        $this->options['query']['SlbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSlbProtocol($value)
    {
        $this->data['SlbProtocol'] = $value;
        $this->options['query']['SlbProtocol'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPort($value)
    {
        $this->data['Port'] = $value;
        $this->options['query']['Port'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetPort($value)
    {
        $this->data['TargetPort'] = $value;
        $this->options['query']['TargetPort'] = $value;

        return $this;
    }
}
