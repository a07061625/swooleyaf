<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getSchema()
 * @method string getBackCategory()
 */
class ListDataStatistics extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchema($value)
    {
        $this->data['Schema'] = $value;
        $this->options['form_params']['Schema'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBackCategory($value)
    {
        $this->data['BackCategory'] = $value;
        $this->options['form_params']['BackCategory'] = $value;

        return $this;
    }
}
