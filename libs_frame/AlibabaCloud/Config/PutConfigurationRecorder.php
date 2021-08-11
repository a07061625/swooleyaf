<?php

namespace AlibabaCloud\Config;

/**
 * @method string getResourceTypes()
 */
class PutConfigurationRecorder extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceTypes($value)
    {
        $this->data['ResourceTypes'] = $value;
        $this->options['form_params']['ResourceTypes'] = $value;

        return $this;
    }
}
