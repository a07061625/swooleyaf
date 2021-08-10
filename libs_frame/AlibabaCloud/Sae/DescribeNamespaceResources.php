<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceId()
 */
class DescribeNamespaceResources extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/namespace/describeNamespaceResources';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceId($value)
    {
        $this->data['NamespaceId'] = $value;
        $this->options['query']['NamespaceId'] = $value;

        return $this;
    }
}
