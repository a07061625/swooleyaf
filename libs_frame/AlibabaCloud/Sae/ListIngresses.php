<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceId()
 * @method string getAppId()
 */
class ListIngresses extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/ingress/IngressList';

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
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }
}
