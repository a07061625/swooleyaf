<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClientToken()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class InstallAckOperator extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/ack-clusters/[ClusterId]/operator';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['ClientToken'] = $value;

        return $this;
    }
}
