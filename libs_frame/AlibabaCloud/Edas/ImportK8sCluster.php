<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getNamespaceId()
 * @method string getClusterId()
 */
class ImportK8sCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/import_k8s_cluster';

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
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['ClusterId'] = $value;

        return $this;
    }
}
