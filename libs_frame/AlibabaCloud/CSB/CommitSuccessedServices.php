<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbName()
 * @method $this withCsbName($value)
 * @method string getServices()
 */
class CommitSuccessedServices extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServices($value)
    {
        $this->data['Services'] = $value;
        $this->options['form_params']['Services'] = $value;

        return $this;
    }
}
