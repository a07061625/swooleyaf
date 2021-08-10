<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getSize()
 * @method string getPage()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class ListAckNamespaces extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/ack-clusters/[ClusterId]/namespaces';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['query']['size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['page'] = $value;

        return $this;
    }
}
