<?php

namespace AlibabaCloud\Market;

/**
 * @method string getApplicationId()
 * @method $this withApplicationId($value)
 * @method string getContent()
 */
class CreateCommodity extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }
}
