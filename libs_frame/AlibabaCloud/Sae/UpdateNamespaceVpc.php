<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceId()
 * @method string getVpcId()
 */
class UpdateNamespaceVpc extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/namespace/updateNamespaceVpc';

    /** @var string */
    public $method = 'POST';

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcId($value)
    {
        $this->data['VpcId'] = $value;
        $this->options['query']['VpcId'] = $value;

        return $this;
    }
}
