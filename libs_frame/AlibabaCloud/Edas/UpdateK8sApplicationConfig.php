<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getMemoryLimit()
 * @method string getClusterId()
 * @method string getCpuLimit()
 */
class UpdateK8sApplicationConfig extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/k8s_app_configuration';

    /** @var string */
    public $method = 'PUT';

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
    public function withMemoryLimit($value)
    {
        $this->data['MemoryLimit'] = $value;
        $this->options['query']['MemoryLimit'] = $value;

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
    public function withCpuLimit($value)
    {
        $this->data['CpuLimit'] = $value;
        $this->options['query']['CpuLimit'] = $value;

        return $this;
    }
}
