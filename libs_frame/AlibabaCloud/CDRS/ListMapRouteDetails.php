<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getRouteList()
 */
class ListMapRouteDetails extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRouteList($value)
    {
        $this->data['RouteList'] = $value;
        $this->options['form_params']['RouteList'] = $value;

        return $this;
    }
}
