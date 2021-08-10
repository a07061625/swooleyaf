<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getClusterId()
 */
class ListConvertableEcu extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/convertable_ecu_list';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['clusterId'] = $value;

        return $this;
    }
}
