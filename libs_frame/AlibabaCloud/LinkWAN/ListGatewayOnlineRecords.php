<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getOffSet()
 * @method string getLimit()
 * @method string getGwEui()
 * @method string getSortingField()
 * @method string getAscending()
 */
class ListGatewayOnlineRecords extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOffSet($value)
    {
        $this->data['OffSet'] = $value;
        $this->options['form_params']['OffSet'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLimit($value)
    {
        $this->data['Limit'] = $value;
        $this->options['form_params']['Limit'] = $value;

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
