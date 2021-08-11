<?php

namespace AlibabaCloud\CS;

/**
 * @method string getKubernetesVersion()
 * @method string getRegion()
 */
class DescribeKubernetesTemplates extends Roa
{
    /** @var string */
    public $pathPattern = '/k8s/templates';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKubernetesVersion($value)
    {
        $this->data['KubernetesVersion'] = $value;
        $this->options['query']['KubernetesVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegion($value)
    {
        $this->data['Region'] = $value;
        $this->options['query']['Region'] = $value;

        return $this;
    }
}
