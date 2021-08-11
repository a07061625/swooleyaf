<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBaselineId()
 */
class ListNodesByBaseline extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBaselineId($value)
    {
        $this->data['BaselineId'] = $value;
        $this->options['form_params']['BaselineId'] = $value;

        return $this;
    }
}
