<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getIngressId()
 */
class DescribeIngress extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/ingress/Ingress';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIngressId($value)
    {
        $this->data['IngressId'] = $value;
        $this->options['query']['IngressId'] = $value;

        return $this;
    }
}
