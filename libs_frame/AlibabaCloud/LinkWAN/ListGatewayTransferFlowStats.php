<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getEndMillis()
 * @method string getBeginMillis()
 * @method string getGwEui()
 * @method string getTimeIntervalUnit()
 */
class ListGatewayTransferFlowStats extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndMillis($value)
    {
        $this->data['EndMillis'] = $value;
        $this->options['form_params']['EndMillis'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeginMillis($value)
    {
        $this->data['BeginMillis'] = $value;
        $this->options['form_params']['BeginMillis'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGwEui($value)
    {
        $this->data['GwEui'] = $value;
        $this->options['form_params']['GwEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeIntervalUnit($value)
    {
        $this->data['TimeIntervalUnit'] = $value;
        $this->options['form_params']['TimeIntervalUnit'] = $value;

        return $this;
    }
}
