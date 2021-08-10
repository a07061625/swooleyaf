<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getLocale()
 */
class DescribeAntChainRegionNames extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocale($value)
    {
        $this->data['Locale'] = $value;
        $this->options['form_params']['Locale'] = $value;

        return $this;
    }
}
