<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getDatabaseString()
 * @method string getClientToken()
 */
class AddDatabaseList extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDatabaseString($value)
    {
        $this->data['DatabaseString'] = $value;
        $this->options['form_params']['DatabaseString'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }
}
