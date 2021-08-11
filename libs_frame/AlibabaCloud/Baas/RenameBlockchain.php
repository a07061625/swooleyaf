<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getBizid()
 * @method string getNewName()
 */
class RenameBlockchain extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNewName($value)
    {
        $this->data['NewName'] = $value;
        $this->options['form_params']['NewName'] = $value;

        return $this;
    }
}
