<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNamespaceId()
 */
class ListNamespacedConfigMaps extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/configmap/listNamespacedConfigMaps';

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
