<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getData()
 * @method string getDescription()
 * @method string getConfigMapId()
 */
class UpdateConfigMap extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/configmap/configMap';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withData($value)
    {
        $this->data['Data'] = $value;
        $this->options['form_params']['Data'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfigMapId($value)
    {
        $this->data['ConfigMapId'] = $value;
        $this->options['query']['ConfigMapId'] = $value;

        return $this;
    }
}
