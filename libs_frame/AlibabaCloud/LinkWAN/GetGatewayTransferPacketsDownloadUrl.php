<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getGwEui()
 * @method string getEndMillis()
 * @method string getDevEui()
 * @method string getCategory()
 * @method string getBeginMillis()
 * @method string getSortingField()
 * @method string getAscending()
 */
class GetGatewayTransferPacketsDownloadUrl extends Rpc
{
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
    public function withDevEui($value)
    {
        $this->data['DevEui'] = $value;
        $this->options['form_params']['DevEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategory($value)
    {
        $this->data['Category'] = $value;
        $this->options['form_params']['Category'] = $value;

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
    public function withSortingField($value)
    {
        $this->data['SortingField'] = $value;
        $this->options['form_params']['SortingField'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAscending($value)
    {
        $this->data['Ascending'] = $value;
        $this->options['form_params']['Ascending'] = $value;

        return $this;
    }
}
