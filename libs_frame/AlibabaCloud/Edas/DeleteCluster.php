<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getClusterId()
 */
class DeleteCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/cluster';

    /** @var string */
    public $method = 'DELETE';

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
