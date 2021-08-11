<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getConfigMapId()
 */
class DescribeConfigMap extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/configmap/configMap';

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
