<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getLatitude()
 * @method string getRadius()
 * @method string getLongitude()
 */
class ListCityMapAois extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLatitude($value)
    {
        $this->data['Latitude'] = $value;
        $this->options['form_params']['Latitude'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRadius($value)
    {
        $this->data['Radius'] = $value;
        $this->options['form_params']['Radius'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLongitude($value)
    {
        $this->data['Longitude'] = $value;
        $this->options['form_params']['Longitude'] = $value;

        return $this;
    }
}
