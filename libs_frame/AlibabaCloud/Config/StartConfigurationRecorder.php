<?php

namespace AlibabaCloud\Config;

/**
 * @method string getEnterpriseEdition()
 */
class StartConfigurationRecorder extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnterpriseEdition($value)
    {
        $this->data['EnterpriseEdition'] = $value;
        $this->options['form_params']['EnterpriseEdition'] = $value;

        return $this;
    }
}
